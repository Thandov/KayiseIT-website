#!/usr/bin/env python3
"""Add logo/logo_sm.png next to the NYDA logo (in the red box area) on all PDFs."""

import sys
import tempfile
from pathlib import Path

import fitz  # PyMuPDF

BASE = Path(__file__).resolve().parent
LOGO_PATH = BASE / "logo" / "logo_sm.png"

# Red box area: to the right of NYDA logo (NYDA is at ~48-131, y 724-794).
# Logo is shrunk by 20% (0.8) and centered in that area.
_rect_full = fitz.Rect(135, 715, 255, 800)
_w, _h = _rect_full.width * 0.8, _rect_full.height * 0.8
_cx, _cy = _rect_full.x0 + _rect_full.width / 2, _rect_full.y0 + _rect_full.height / 2
LOGO_RECT = fitz.Rect(_cx - _w / 2, _cy - _h / 2, _cx + _w / 2, _cy + _h / 2)


# Full rect we may have used before (for covering old logo when re-running)
OLD_LOGO_RECT = fitz.Rect(135, 715, 255, 800)


def add_logo_to_pdf(pdf_path: Path, logo_path: Path, replace_existing: bool = True) -> bool:
    """Overlay logo on first page of PDF at LOGO_RECT. Returns True on success.
    If replace_existing, draw white over OLD_LOGO_RECT first to hide a previous logo.
    """
    try:
        doc = fitz.open(pdf_path)
        if len(doc) == 0:
            doc.close()
            return False
        page = doc[0]
        if replace_existing:
            shape = page.new_shape()
            shape.draw_rect(OLD_LOGO_RECT)
            shape.finish(color=(1, 1, 1), fill=(1, 1, 1))
            shape.commit()
        page.insert_image(LOGO_RECT, filename=str(logo_path), keep_proportion=True)
        with tempfile.NamedTemporaryFile(suffix=".pdf", delete=False, dir=pdf_path.parent) as tmp:
            tmp_path = Path(tmp.name)
        doc.save(str(tmp_path), garbage=4, deflate=True)
        doc.close()
        tmp_path.replace(pdf_path)
        return True
    except Exception:
        return False


def main():
    if not LOGO_PATH.exists():
        print(f"Logo not found: {LOGO_PATH}")
        sys.exit(1)

    pdf_files = list(BASE.rglob("*.pdf"))
    total = len(pdf_files)
    if not total:
        print("No PDF files found.")
        return

    print(f"Logo: {LOGO_PATH}")
    print(f"Position (red box area): {LOGO_RECT}")
    print(f"Found {total} PDF(s). Adding logo...")
    ok = 0
    err = 0
    for i, pdf_path in enumerate(pdf_files, 1):
        if add_logo_to_pdf(pdf_path, LOGO_PATH):
            print(f"  [{i}/{total}] {pdf_path.name}")
            ok += 1
        else:
            print(f"  [{i}/{total}] ERROR {pdf_path.name}")
            err += 1

    print(f"\nDone. Updated: {ok}, Errors: {err}")


if __name__ == "__main__":
    main()
