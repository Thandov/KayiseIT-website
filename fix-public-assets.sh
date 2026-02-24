#!/bin/bash
# Run this ON THE SERVER (SSH) from the project root: ~/public_html/kayiseit.com
# Fixes 404s for /images/, /css/, etc. when document root is project root (not public/)

set -e
cd "$(dirname "$0")"

echo "=== Fixing public asset paths (symlinks from root to public/) ==="
echo "Current directory: $(pwd)"

# Remove if they exist as broken symlinks or wrong type
for name in images css build js fonts webfonts assets; do
  if [ -e "$name" ] && [ ! -L "$name" ]; then
    echo "WARNING: $name exists and is not a symlink - skipping (move or remove it first)"
    continue
  fi
  rm -f "$name"
  if [ -d "public/$name" ]; then
    ln -sfn "public/$name" "$name"
    echo "Linked: $name -> public/$name"
  fi
done

echo ""
echo "=== Verifying ==="
ls -la images 2>/dev/null && echo "images: OK" || echo "images: MISSING"
ls -la css 2>/dev/null && echo "css: OK" || echo "css: MISSING"
ls -la build 2>/dev/null && echo "build: OK" || echo "build: MISSING"
echo ""
echo "Done. Reload https://www.kayiseit.com and hard-refresh (Ctrl+Shift+R)."
