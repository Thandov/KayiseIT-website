# DOCX → PDF conversion: why text can look squashed

When you convert the certificate `.docx` to PDF with **LibreOffice** (headless), some text—especially **italic** lines like “This is to certify that” and “has complied with the requirements”—can look squashed or overlapping. That is **not** done on purpose; it’s a side effect of how the conversion works.

## Why it happens

1. **Font substitution**  
   The certificate template likely uses specific fonts (e.g. from Windows or Word). On your Mac, LibreOffice may not have the exact same font or its italic variant. It then substitutes another font. If the substitute has different metrics (width, spacing), characters can overlap or look squashed.

2. **Italic vs regular**  
   Italic text is often hit hardest because:
   - The italic version of the font may be missing, so LibreOffice falls back to a different font or a slanted regular font.
   - Substitute italic metrics often don’t match the original, so spacing breaks and text looks compressed.

3. **Headless conversion**  
   Converting in headless mode (no GUI) can make font discovery and embedding slightly different from opening the file in LibreOffice and exporting manually, which can worsen the effect.

## What you can do

- **Use the same fonts as the template**  
  Install on your Mac the same fonts used in the certificate (e.g. copy from the machine where the template was made). Then run the conversion again so LibreOffice doesn’t substitute.

- **Convert with Microsoft Word**  
  If the template was made in Word, converting with Word (e.g. “Save as PDF”) usually preserves spacing and avoids squashing. We tried automating this with `docx2pdf`; it failed on your setup, but you can still use Word’s “Save as PDF” manually for important certificates.

- **Adjust the template in LibreOffice**  
  Open the certificate in LibreOffice, switch problematic italic text to a font that you know is installed (e.g. “Liberation Serif Italic”), then save and use that version for conversion. That can remove the squashing without changing the design much.

The conversion script itself does not squash text on purpose; it’s the font handling during DOCX → PDF that causes it.
