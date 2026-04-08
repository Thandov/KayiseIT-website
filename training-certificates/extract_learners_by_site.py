"""
Extract learner Name, Surname, and ID from certificate PDFs and DOCX files,
then save two CSVs: one per site (Barberton, Kabokweni).
"""
import csv
import re
import zipfile
from pathlib import Path

try:
    from pypdf import PdfReader
except ImportError:
    PdfReader = None

BASE = Path(__file__).resolve().parent
CERTS_ROOT = BASE / "CERTIFICATES"
BARBERTON_DIR = CERTS_ROOT / "Barberton Certificates"
KABOKWENI_DIR = CERTS_ROOT / "KABOKWENI CERTIFICATES"

# Match "ID: " followed by 13 digits (SA ID number)
ID_PATTERN = re.compile(r"ID:\s*(\d{13})")
# Match "Certificate No" or "Certificate No:" followed by number (e.g. UE2524 5 or UE25245)
CERT_NO_PATTERN = re.compile(r"Certificate No\.?\s*:?\s*([A-Z0-9]+(?:\s*[A-Z0-9]+)*)", re.IGNORECASE)


def extract_text_docx(path: Path) -> str:
    """Extract plain text from a .docx file."""
    text_parts = []
    try:
        with zipfile.ZipFile(path, "r") as z:
            if "word/document.xml" not in z.namelist():
                return ""
            xml = z.read("word/document.xml").decode("utf-8")
    except Exception:
        return ""
    # Strip XML tags and normalize whitespace
    text = re.sub(r"<[^>]+>", " ", xml)
    text = re.sub(r"\s+", " ", text).strip()
    return text


def extract_text_pdf(path: Path) -> str:
    """Extract plain text from a PDF file."""
    if PdfReader is None:
        return ""
    try:
        reader = PdfReader(path)
        parts = []
        for page in reader.pages:
            parts.append(page.extract_text() or "")
        return "\n".join(parts)
    except Exception:
        return ""


def extract_id_from_text(text: str) -> str:
    """Return first 13-digit ID after 'ID:' in text, else empty string."""
    m = ID_PATTERN.search(text)
    return m.group(1) if m else ""


def extract_certificate_number_from_text(text: str) -> str:
    """Return first certificate number after 'Certificate No' in text, else empty string."""
    m = CERT_NO_PATTERN.search(text)
    if not m:
        return ""
    # Normalize: remove all spaces so "UE252 74" -> "UE25274"
    num = re.sub(r"\s+", "", m.group(1).strip())
    return num


def parse_name_from_filename(filename: str) -> tuple[str, str]:
    """
    Parse 'Certificate of Completion- FIRST MIDDLE SURNAME.docx' -> (Name, Surname).
    Name = all but last word, Surname = last word.
    """
    # Remove extension and prefix
    name = filename
    for ext in (".docx", ".pdf"):
        name = name.replace(ext, "")
    if "Certificate of Completion-" in name:
        name = name.split("Certificate of Completion-", 1)[-1]
    name = re.sub(r"\s+", " ", name).strip()
    parts = [p for p in name.split() if p]
    if not parts:
        return "", ""
    if len(parts) == 1:
        return "", parts[0]
    return " ".join(parts[:-1]), parts[-1]


def process_folder(folder: Path) -> list[dict]:
    """Scan folder for .docx and .pdf; extract Name, Surname, ID. Return list of rows."""
    rows = []
    seen = set()  # avoid duplicates by (name, surname)

    for path in sorted(folder.iterdir()):
        if not path.is_file():
            continue
        suf = path.suffix.lower()
        if suf not in (".docx", ".pdf"):
            continue
        # Skip non-certificate files
        if "Certificate of Completion" not in path.name or "ROLLOUT" in path.name:
            continue

        name_from_file, surname_from_file = parse_name_from_filename(path.name)
        text = extract_text_docx(path) if suf == ".docx" else extract_text_pdf(path)
        id_number = extract_id_from_text(text)
        certificate_number = extract_certificate_number_from_text(text)

        # Dedupe by name+surname (some filenames may have trailing space etc.)
        key = (name_from_file.strip().lower(), surname_from_file.strip().lower())
        if key in seen:
            continue
        seen.add(key)

        rows.append({
            "Name": name_from_file.strip(),
            "Surname": surname_from_file.strip(),
            "ID number": id_number,
            "Certificate number": certificate_number,
        })

    return rows


def main():
    barberton = process_folder(BARBERTON_DIR)
    kabokweni = process_folder(KABOKWENI_DIR)

    def write_csv(path: Path, rows: list[dict]):
        with open(path, "w", newline="", encoding="utf-8") as f:
            w = csv.DictWriter(
                f,
                fieldnames=["Surname", "Name", "ID number", "Certificate number"],
            )
            w.writeheader()
            w.writerows(rows)

    write_csv(BASE / "barberton_learners.csv", barberton)
    write_csv(BASE / "kabokweni_learners.csv", kabokweni)

    print(f"Barberton: {len(barberton)} learners -> barberton_learners.csv")
    print(f"Kabokweni: {len(kabokweni)} learners -> kabokweni_learners.csv")


if __name__ == "__main__":
    main()
