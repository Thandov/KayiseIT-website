"""Partner logo helpers: SVG wraps embedded PNG/JPEG (ReportLab cannot load SVG directly)."""

import base64
import io
import re
from pathlib import Path
from typing import Optional, Union

_EMBEDDED_DATA_URI = re.compile(
    r'(?:href|xlink:href)\s*=\s*["\']data:image/(?:png|jpeg|jpg);base64,([^"\')\s]+)',
    re.IGNORECASE,
)


def raster_bytes_from_svg(svg_path: Path) -> Optional[bytes]:
    """Return decoded PNG/JPEG bytes from first embedded data URI in SVG, or None."""
    try:
        text = svg_path.read_text(encoding="utf-8")
    except OSError:
        return None
    m = _EMBEDDED_DATA_URI.search(text)
    if not m:
        return None
    try:
        return base64.b64decode(m.group(1))
    except Exception:
        return None


def _rgba_knock_out_dark_background(rgba, rgb_max: int = 25):
    """Partner PNG is dark gray marks on an opaque black matte (not transparency). Flatten-on-white
    would otherwise leave a black rectangle. Knock out only near-black pixels so strokes (typically
    mid-30s–40s RGB in current artwork) remain."""
    pixels = rgba.getdata()
    cleared = [
        (255, 255, 255, 0)
        if max(r, g, b) <= rgb_max
        else (r, g, b, a)
        for (r, g, b, a) in pixels
    ]
    rgba.putdata(cleared)
    return rgba


def flatten_logo_on_white_jpeg_bytes(logo_path: Path) -> bytes:
    """Opaque JPEG bytes for ReportLab / PyMuPDF (avoids PNG alpha / SVG issues)."""
    from PIL import Image

    src: Union[Path, io.BytesIO]
    if logo_path.suffix.lower() == ".svg":
        raw = raster_bytes_from_svg(logo_path)
        if raw is None:
            raise ValueError(f"No embedded PNG/JPEG in SVG: {logo_path}")
        src = io.BytesIO(raw)
    else:
        src = logo_path

    with Image.open(src) as im:
        rgba = im.convert("RGBA")
        _rgba_knock_out_dark_background(rgba)
        bg = Image.new("RGBA", rgba.size, (255, 255, 255, 255))
        flat = Image.alpha_composite(bg, rgba).convert("RGB")
        buf = io.BytesIO()
        flat.save(buf, format="JPEG", quality=98, optimize=True)
        return buf.getvalue()
