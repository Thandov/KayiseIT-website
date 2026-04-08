#!/usr/bin/env python3
"""Convert all .docx files in the project to .pdf (same folder, same base name)."""

import subprocess
import sys
from pathlib import Path

BASE = Path(__file__).resolve().parent

# Prefer Homebrew LibreOffice, then standard app path
SOFFICE_PATHS = [
    "/opt/homebrew/bin/soffice",
    "/usr/local/bin/soffice",
    "/Applications/LibreOffice.app/Contents/MacOS/soffice",
]


def get_soffice():
    for p in SOFFICE_PATHS:
        if Path(p).exists():
            return p
    return None


def main():
    base = BASE
    docx_files = list(base.rglob("*.docx"))
    total = len(docx_files)
    if not total:
        print("No .docx files found.")
        return

    soffice = get_soffice()
    if not soffice:
        print("LibreOffice (soffice) not found. Install it with: brew install --cask libreoffice")
        sys.exit(1)

    print(f"Using: {soffice}")
    print(f"Found {total} .docx file(s). Converting to PDF...")
    ok = 0
    err = 0
    for i, docx_path in enumerate(docx_files, 1):
        out_dir = docx_path.parent
        try:
            subprocess.run(
                [
                    soffice,
                    "--headless",
                    "--convert-to", "pdf",
                    "--outdir", str(out_dir),
                    str(docx_path),
                ],
                check=True,
                capture_output=True,
                timeout=60,
            )
            pdf_name = docx_path.with_suffix(".pdf").name
            print(f"  [{i}/{total}] {docx_path.name} -> {pdf_name}")
            ok += 1
        except subprocess.CalledProcessError as e:
            print(f"  [{i}/{total}] ERROR {docx_path.name}: {e.stderr.decode() if e.stderr else e}")
            err += 1
        except Exception as e:
            print(f"  [{i}/{total}] ERROR {docx_path.name}: {e}")
            err += 1

    print(f"\nDone. Converted: {ok}, Errors: {err}")


if __name__ == "__main__":
    main()
