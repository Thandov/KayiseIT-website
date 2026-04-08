#!/usr/bin/env python
"""
Generate UNISA ENTERPRISE Certificate of Completion PDF — exact template:
double red border, Times (serif) fonts, same layout as the reference.
"""

import io
from pathlib import Path
from typing import Optional

from reportlab.lib import colors
from reportlab.lib.pagesizes import A4
from reportlab.lib.utils import ImageReader
from reportlab.pdfgen import canvas
from reportlab.platypus import Table, TableStyle

# Paths: logo folder + signature folder (use signature from signature folder)
BASE_DIR = Path(__file__).resolve().parent
LOGO_DIR = BASE_DIR / "logo"
SIGNATURE_DIR = BASE_DIR / "signature"
UNISA_LOGO_PATH = LOGO_DIR / "unisa.jpg"
NYDA_LOGO_PATH = LOGO_DIR / "nyda.jpg"
KAYISE_LOGO_PATH = LOGO_DIR / "logo_sm.png"  # partner logo

def _find_signature_image() -> Optional[Path]:
    """Use image from signature folder (e.g. signature/signature.jpg)."""
    if not SIGNATURE_DIR.exists():
        return None
    for name in ("signature.jpg", "signature.png", "lerato_mothibi.jpg", "lerato_mothibi.png"):
        p = SIGNATURE_DIR / name
        if p.exists():
            return p
    for f in SIGNATURE_DIR.iterdir():
        if f.is_file() and f.suffix.lower() in (".jpg", ".jpeg", ".png", ".gif"):
            return f
    return None

# --- Dimensions copied from reference: KABOKWENI CERTIFICATES/Certificate of Completion- THAMARA MHLANGA.pdf ---
# Use exact reference page size so all coordinates match (596.52 x 843 pt)
PAGE_W, PAGE_H = 596.52, 843.0

# Border (from reference paths): inner content rect 30.36 pt from each edge; outer ~28 pt
MARGIN_PT = 30.36
BORDER_GAP_PT = 1.3
OUTER_PT = 28.0
BORDER_STROKE_OUTER = 0.7
BORDER_STROKE_INNER = 0.72
RED = (0.55, 0.12, 0.12)
BLACK = (0, 0, 0)

MARGIN = MARGIN_PT
INNER = MARGIN_PT + BORDER_GAP_PT
INNER_W = PAGE_W - 2 * INNER
INNER_H = PAGE_H - 2 * INNER

# Content boundary (purple lines): 15% and 85% of page width — all content inside
CONTENT_LEFT = 0.15 * PAGE_W
CONTENT_RIGHT = 0.85 * PAGE_W
CONTENT_WIDTH = CONTENT_RIGHT - CONTENT_LEFT
CONTENT_CENTER_X = (CONTENT_LEFT + CONTENT_RIGHT) / 2

# UNISA logo: centered in content boundary
UNISA_LOGO_W_PT = 149.4
UNISA_LOGO_H_PT = 182.8
UNISA_LOGO_CENTER_X = CONTENT_CENTER_X
UNISA_LOGO_BOTTOM_Y = 621.2

# Text y positions (ReportLab = from bottom). Reference: fitz y from top -> ReportLab y = 843 - fitz_y
Y_TITLE = 577          # Certificate of Completion, size 24
Y_CERTIFY = 526        # This is to certify that, size 17
Y_NAME = 478           # size 18
Y_ID = 435             # size 18
Y_COMPLIED = 395       # has complied..., size 16
Y_COURSE = 345         # Course title, size 16
Y_TABLE_HEADER = 308   # Table header row
# Table: fits inside content boundary (left = CONTENT_LEFT, total width = CONTENT_WIDTH)
TABLE_LEFT_PT = CONTENT_LEFT
TABLE_COL1_W_PT = CONTENT_WIDTH * 0.85
TABLE_COL2_W_PT = CONTENT_WIDTH * 0.15
TABLE_ROW_H_PT = 15.5
TABLE_HEADER_H_PT = 22
# Signature block — inside boundary; left block at CONTENT_LEFT, right block at CONTENT_RIGHT
Y_SIGNATURE_LINE = 151
SIGNATURE_LEFT_PT = CONTENT_LEFT
SIGNATURE_LINE_W_PT = min(141, CONTENT_WIDTH * 0.35)
DATE_RIGHT_X = CONTENT_RIGHT
# Signature image: sit just above the line (not too high), same vertical band as date
SIGNATURE_IMG_W_PT = 100
SIGNATURE_IMG_H_PT = 28
SIGNATURE_IMG_GAP_ABOVE_LINE = 4   # pt between signature bottom and line
# Right block: date and line aligned with left (same y as left line)
Y_DATE_PT = 158           # date above its line
Y_DATE_LINE_PT = 151      # same as Y_SIGNATURE_LINE so both lines align
# Labels just below line — same y for "Programme Manager Signature" and "Date of Issue"
Y_LABEL_BELOW_LINE = 141  # same baseline for both left and right label (line_y - 10)
Y_CERT_NO_PT = 125       # "Certificate No: xxx" — below Date of Issue
DATE_LINE_W_PT = 100
PROG_MGR_LABEL_GAP_BELOW_LINE = 10
# Footer logos: inside content boundary (NYDA left edge at CONTENT_LEFT, KAYISE right at CONTENT_RIGHT)
NYDA_LEFT_PT = CONTENT_LEFT
NYDA_BOTTOM_PT = 55.9
NYDA_W_PT = 82.4
NYDA_H_PT = 69.6
KAYISE_W_PT = 96
KAYISE_H_PT = 50.9
KAYISE_BOTTOM_PT = 60.1
KAYISE_RIGHT_PT = CONTENT_RIGHT  # right edge of KAYISE logo (inside boundary)

# Built-in serif (Times) — same family as reference
FONT_SERIF = "Times-Roman"
FONT_SERIF_BOLD = "Times-Bold"
FONT_SERIF_ITALIC = "Times-Italic"
FONT_SERIF_BOLD_ITALIC = "Times-BoldItalic"

# Topic rows (exact text from reference)
TOPICS = [
    "Introduction to Financial Planning and Financial Planning Analysis",
    "Business Budgeting and Digital Marketing Strategy",
    "Developing Contingency and Risk plans for Business",
    "Entrepreneurial Mindset and its role in Success",
    "Managing your Business Debts – Expenditure and Expenses of a Business",
]
NQF_LEVEL = "4"
DEFAULT_COURSE = "BUSINESS ESSENTIALS FOR ENTREPRENEURS"


def draw_double_border(c: canvas.Canvas):
    """Draw double border to match reference: outer then inner."""
    c.setStrokeColorRGB(*BLACK)
    c.setLineWidth(BORDER_STROKE_OUTER)
    c.rect(OUTER_PT, OUTER_PT, PAGE_W - 2 * OUTER_PT, PAGE_H - 2 * OUTER_PT, stroke=1, fill=0)
    c.setStrokeColorRGB(*RED)
    c.setLineWidth(BORDER_STROKE_INNER)
    c.rect(INNER, INNER, INNER_W, INNER_H, stroke=1, fill=0)


def _draw_image_in_rect(
    c: canvas.Canvas,
    path: Path,
    x_center: float,
    y_bottom: float,
    box_w: float,
    box_h: float,
    use_alpha: bool = False,
) -> bool:
    """Draw image centered in a fixed box. Scale to fit, preserve aspect. If use_alpha True, PNG transparency is respected (mask='auto')."""
    if not path.exists():
        return False
    try:
        img = ImageReader(str(path))
        iw, ih = img.getSize()
        scale = min(box_w / iw, box_h / ih)
        w, h = iw * scale, ih * scale
        x = x_center - w / 2
        y = y_bottom - h
        if use_alpha:
            c.drawImage(img, x, y, width=w, height=h, mask="auto")
        else:
            c.drawImage(img, x, y, width=w, height=h)
        return True
    except Exception:
        return False


def _draw_image_scaled(c: canvas.Canvas, path: Path, x_center: float, y_baseline: float, max_w: float, max_h: float) -> float:
    """Draw image centered at (x_center, y_baseline), scaled to fit max_w x max_h. Returns height used (pt)."""
    if not path.exists():
        return 0.0
    try:
        img = ImageReader(str(path))
        iw, ih = img.getSize()
        scale = min(max_w / iw, max_h / ih, 1.0)
        w, h = iw * scale, ih * scale
        x = x_center - w / 2
        y = y_baseline - h
        c.drawImage(img, x, y, width=w, height=h)
        return h
    except Exception:
        return 0.0


def draw_header(c: canvas.Canvas) -> None:
    """Draw UNISA logo at reference position/size, then ''."""
    logo_top = UNISA_LOGO_BOTTOM_Y + UNISA_LOGO_H_PT
    drawn = _draw_image_in_rect(c, UNISA_LOGO_PATH, UNISA_LOGO_CENTER_X, logo_top, UNISA_LOGO_W_PT, UNISA_LOGO_H_PT)
    if not drawn:
        c.setFillColorRGB(*BLACK)
        c.setFont("Helvetica-Bold", 20)
        c.drawCentredString(PAGE_W / 2, UNISA_LOGO_BOTTOM_Y + UNISA_LOGO_H_PT * 0.5, "UNISA ENTERPRISE")
    # Reference: subsidiary text between logo and title
    y_subs = UNISA_LOGO_BOTTOM_Y - 8
    c.setFillColorRGB(*BLACK)
    c.setFont("Helvetica", 9)
    c.drawCentredString(CONTENT_CENTER_X, y_subs, "")


def draw_title(c: canvas.Canvas) -> None:
    """Draw 'Certificate of Completion' centered in content boundary."""
    c.setFillColorRGB(*RED)
    c.setFont(FONT_SERIF_BOLD, 24)
    c.drawCentredString(CONTENT_CENTER_X, Y_TITLE, "Certificate of Completion")


def draw_recipient_block(c: canvas.Canvas, full_name: str, id_number: str, course: str) -> None:
    """Draw certify / name / ID / compliance / course centered in content boundary."""
    c.setFillColorRGB(*BLACK)
    c.setFont(FONT_SERIF_ITALIC, 17)
    c.drawCentredString(CONTENT_CENTER_X, Y_CERTIFY, "This is to certify that")
    c.setFont(FONT_SERIF_BOLD, 18)
    c.drawCentredString(CONTENT_CENTER_X, Y_NAME, full_name.upper())
    c.drawCentredString(CONTENT_CENTER_X, Y_ID, f"ID: {id_number}")
    c.setFont(FONT_SERIF_ITALIC, 16)
    c.drawCentredString(CONTENT_CENTER_X, Y_COMPLIED, "has complied with the requirements for the")
    c.setFont(FONT_SERIF_BOLD, 16)
    c.drawCentredString(CONTENT_CENTER_X, Y_COURSE, course.upper())


def draw_topics_table(c: canvas.Canvas) -> None:
    """Draw topics table at reference position and column widths (Calibri 11 in reference; use Helvetica 10)."""
    data = [["Description of Topics Covered", "NQF Level"]]
    for t in TOPICS:
        data.append([t, NQF_LEVEL])

    t = Table(
        data,
        colWidths=[TABLE_COL1_W_PT, TABLE_COL2_W_PT],
        rowHeights=[TABLE_HEADER_H_PT] + [TABLE_ROW_H_PT] * len(TOPICS),
    )
    # Table border: match reference — full box + vertical between columns + horizontal between rows (~0.5 pt)
    line_pt = 0.5
    t.setStyle(
        TableStyle(
            [
                ("FONT", (0, 0), (-1, -1), "Helvetica", 10),
                ("FONT", (0, 0), (-1, 0), "Helvetica-Bold", 10),
                ("ALIGN", (0, 0), (0, -1), "LEFT"),
                ("ALIGN", (1, 0), (1, -1), "CENTER"),
                ("VALIGN", (0, 0), (-1, -1), "MIDDLE"),
                # Full box
                ("LINEABOVE", (0, 0), (-1, 0), line_pt, colors.black),
                ("LINEBELOW", (0, -1), (-1, -1), line_pt, colors.black),
                ("LINEBEFORE", (0, 0), (0, -1), line_pt, colors.black),
                ("LINEAFTER", (-1, 0), (-1, -1), line_pt, colors.black),
                # Horizontal lines between all rows
                ("LINEBELOW", (0, 0), (-1, -1), line_pt, colors.black),
                # Vertical line between columns
                ("LINEAFTER", (0, 0), (0, -1), line_pt, colors.black),
                ("LEFTPADDING", (0, 0), (-1, -1), 4),
                ("RIGHTPADDING", (0, 0), (-1, -1), 4),
                ("TOPPADDING", (0, 0), (-1, -1), 2),
                ("BOTTOMPADDING", (0, 0), (-1, -1), 2),
            ]
        )
    )
    tw, th = t.wrap(0, 0)
    table_bottom_y = Y_TABLE_HEADER - th
    # Table left-aligned to content boundary; fits within CONTENT_WIDTH
    t.drawOn(c, TABLE_LEFT_PT, table_bottom_y)


def draw_signature_block(c: canvas.Canvas, date_issued: str, cert_no: str, manager_name: str = "Lerato Mothibi") -> None:
    """Match original layout: signature image above left line, then line, then label; date above right line, then line, then labels."""
    c.setFillColorRGB(*BLACK)
    line_y = Y_SIGNATURE_LINE
    left_center_x = SIGNATURE_LEFT_PT + SIGNATURE_LINE_W_PT / 2

    # Left: signature image from signature folder — just above the line (aligned, not floating high)
    sig_path = _find_signature_image()
    if sig_path:
        sig_bottom = line_y + SIGNATURE_IMG_GAP_ABOVE_LINE
        _draw_image_in_rect(
            c, sig_path,
            left_center_x,
            sig_bottom + SIGNATURE_IMG_H_PT,
            SIGNATURE_IMG_W_PT, SIGNATURE_IMG_H_PT,
        )
    else:
        c.setFont("Helvetica-Oblique", 10)
        c.drawString(SIGNATURE_LEFT_PT, line_y + 4, manager_name)

    # Left horizontal line, then label just below (aligned spacing)
    c.line(SIGNATURE_LEFT_PT, line_y, SIGNATURE_LEFT_PT + SIGNATURE_LINE_W_PT, line_y)
    c.setFont("Helvetica-Bold", 10)
    c.drawString(SIGNATURE_LEFT_PT, Y_LABEL_BELOW_LINE, "Programme Manager Signature")

    # Right: date above line, then line, then "Date of Issue" and "Certificate No" (same y as left label)
    c.setFont("Helvetica-Bold", 10)
    c.drawRightString(DATE_RIGHT_X, Y_DATE_PT, date_issued)
    date_line_left = DATE_RIGHT_X - DATE_LINE_W_PT
    c.line(date_line_left, Y_DATE_LINE_PT, DATE_RIGHT_X, Y_DATE_LINE_PT)
    c.drawRightString(DATE_RIGHT_X, Y_LABEL_BELOW_LINE, "Date of Issue")
    c.setFont("Helvetica-Bold", 10)
    c.drawRightString(DATE_RIGHT_X, Y_CERT_NO_PT, f"Certificate No: {cert_no}")


def draw_footer_logos(c: canvas.Canvas) -> None:
    """Draw all footer logos from logo folder: NYDA (left), partner logo_sm (right)."""
    if NYDA_LOGO_PATH.exists():
        _draw_image_in_rect(
            c, NYDA_LOGO_PATH,
            NYDA_LEFT_PT + NYDA_W_PT / 2, NYDA_BOTTOM_PT + NYDA_H_PT,
            NYDA_W_PT, NYDA_H_PT,
        )
    else:
        c.setFillColorRGB(*BLACK)
        c.setFont("Helvetica", 8)
        c.drawString(NYDA_LEFT_PT, NYDA_BOTTOM_PT, "NATIONAL YOUTH DEVELOPMENT AGENCY")
    if KAYISE_LOGO_PATH.exists():
        kayise_center_x = KAYISE_RIGHT_PT - KAYISE_W_PT / 2
        y_bottom = KAYISE_BOTTOM_PT + KAYISE_H_PT
        _draw_image_in_rect(c, KAYISE_LOGO_PATH, kayise_center_x, y_bottom, KAYISE_W_PT, KAYISE_H_PT, use_alpha=True)
    else:
        c.setFont("Helvetica-Bold", 9)
        c.drawString(KAYISE_RIGHT_PT - 50, KAYISE_BOTTOM_PT + 10, "KAYISE IT")


def build_certificate(
    output_path: Path,
    full_name: str = "ZANELE SPHIWE KHOZA",
    id_number: str = "0605280788080",
    course: str = DEFAULT_COURSE,
    date_issued: str = "20/10/2025",
    certificate_no: str = "UE25401",
    programme_manager: str = "Lerato Mothibi",
) -> None:
    """Build certificate using exact dimensions from reference PDF. Uses all logos in logo/ and signature image if present."""
    c = canvas.Canvas(str(output_path), pagesize=(PAGE_W, PAGE_H))
    c.setTitle("Certificate of Completion")

    draw_header(c)
    draw_title(c)
    draw_recipient_block(c, full_name, id_number, course)
    draw_topics_table(c)
    draw_signature_block(c, date_issued, certificate_no, programme_manager)
    draw_footer_logos(c)
    draw_double_border(c)

    c.save()


def main():
    import argparse
    import csv
    from datetime import date

    base = Path(__file__).resolve().parent
    parser = argparse.ArgumentParser(description="Generate UNISA ENTERPRISE certificate PDF(s).")
    parser.add_argument(
        "csv_files",
        type=Path,
        nargs="*",
        help="One or more CSV files (columns: Name, Surname, ID number, Certificate number)",
    )
    parser.add_argument("--output-dir", type=Path, default=base / "certificates", help="Parent directory for output (default: certificates/)")
    parser.add_argument("--course", default=DEFAULT_COURSE, help="Course title")
    parser.add_argument("--date", default="20/10/2025", help="Date of issue (dd/mm/yyyy)")
    parser.add_argument("--single", action="store_true", help="Generate single sample certificate only")
    args = parser.parse_args()

    if args.single or not args.csv_files:
        out = base / "Certificate_UNISA_Enterprise_template.pdf"
        build_certificate(
            out,
            full_name="ZANELE SPHIWE KHOZA",
            id_number="0605280788080",
            course=args.course,
            date_issued=args.date,
            certificate_no="UE25401",
        )
        print(f"Saved: {out}")
        return

    output_dir = args.output_dir.resolve()
    try:
        output_dir.mkdir(parents=True, exist_ok=True)
    except OSError as e:
        print(f"Error: could not create output directory {output_dir}")
        print("Use a path that exists or that you can write to, e.g. '.' or 'certificates'")
        raise SystemExit(1) from e

    for csv_path in args.csv_files:
        if not csv_path.exists():
            print(f"Skipping (not found): {csv_path}")
            continue
        # Folder per CSV: e.g. barberton_learners.csv -> barberton_learners/
        folder_name = csv_path.stem
        out_dir = output_dir / folder_name
        out_dir.mkdir(parents=True, exist_ok=True)
        print(f"Output folder: {out_dir}")
        with open(csv_path, newline="", encoding="utf-8") as f:
            reader = csv.DictReader(f)
            for row in reader:
                name = (row.get("Name", "") or "").strip()
                surname = (row.get("Surname", "") or "").strip()
                full_name = f"{name} {surname}".strip() or "Recipient"
                id_number = (row.get("ID number", "") or "").strip()
                cert_no = (row.get("Certificate number", "") or "").strip() or "UE25401"
                safe_name = full_name.replace("/", "-").replace(" ", "_")[:50]
                out_path = out_dir / f"Certificate_{safe_name}.pdf"
                build_certificate(
                    out_path,
                    full_name=full_name,
                    id_number=id_number or "0000000000000",
                    course=args.course,
                    date_issued=args.date,
                    certificate_no=cert_no,
                )
                print(f"  Saved: {out_path}")
    print("Done.")


if __name__ == "__main__":
    main()
