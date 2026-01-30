# Deploy KayiseIT Laravel App with Git + SSH

Step-by-step guide for deploying this Laravel app to your server using Git and SSH.

---

## Prerequisites

- **Server** with SSH access (VPS, cloud server, or shared hosting with SSH)
- **Git** installed on your Mac and on the server
- **PHP** (7.4+), **Composer**, and **Node.js** (for `npm run build`) on the server
- A **Git remote** (GitHub, GitLab, or Bitbucket) — or you can push from server to server

---

## Part 1: Local setup (your Mac)

### 1.1 Ensure Git is initialized and add a remote

If you haven’t already:

```bash
cd /Applications/MAMP/htdocs/KayiseIT-website

# Initialize Git (only if not already)
git init

# Add your remote (replace with your repo URL)
git remote add origin https://github.com/YOUR_USERNAME/KayiseIT-website.git
# or: git remote add origin git@github.com:YOUR_USERNAME/KayiseIT-website.git
```

### 1.2 Use a proper .gitignore

Make sure the project root has a `.gitignore` that excludes:

- `node_modules/`
- `vendor/`
- `.env`
- `public/hot`
- `public/storage` (you’ll link this on the server)
- IDE and OS junk (`.DS_Store`, `.idea`, etc.)

**Choice for build assets:**

- **Option A – Build on server (recommended):**  
  Add `public/build/` to `.gitignore`.  
  Don’t commit the build; run `npm run build` on the server after each deploy.

- **Option B – Commit the build:**  
  Do **not** ignore `public/build/`.  
  Run `npm run build` locally, commit `public/build/`, and push.  
  No need to run Node/npm on the server.

### 1.3 Build assets (if you commit the build – Option B)

```bash
npm run build
```

### 1.4 Commit and push

```bash
git add .
git status   # double-check: no .env, no node_modules, no vendor
git commit -m "Deploy: app + build assets"
git push -u origin main
```

(Use your actual branch name if it’s not `main`, e.g. `master` or `2026-kayise`.)

---

## Part 2: Server setup (first time only)

SSH into your server:

```bash
ssh your_user@your-server-ip
# or: ssh your_user@kayiseit.com
```

### 2.1 Install PHP, Composer, Node (if not already)

**Ubuntu/Debian example:**

```bash
# PHP and extensions Laravel needs
sudo apt update
sudo apt install php php-cli php-fpm php-mysql php-xml php-mbstring php-curl php-zip unzip

# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Node.js 18.x (for npm run build if you build on server)
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

### 2.2 Choose app directory

Typical paths:

- **Nginx/Apache with one site:** `/var/www/html` or `/var/www/kayiseit`
- **Shared hosting:** e.g. `~/domains/kayiseit.com` or `~/public_html` (often you put Laravel **above** `public_html` and only `public` is web root — see your host’s Laravel docs)

Set a variable for the rest of the steps (change path if yours is different):

```bash
export APP_PATH=/var/www/kayiseit
```

### 2.3 Clone the repo (first time)

```bash
sudo mkdir -p $APP_PATH
sudo chown $USER:$USER $APP_PATH
cd $APP_PATH

git clone https://github.com/YOUR_USERNAME/KayiseIT-website.git .
# or: git clone git@github.com:YOUR_USERNAME/KayiseIT-website.git .
```

### 2.4 Install PHP dependencies

```bash
cd $APP_PATH
composer install --no-dev --optimize-autoloader
```

### 2.5 Build frontend (only if you build on server – Option A)

```bash
npm ci
npm run build
```

You can remove Node afterward if you want: `rm -rf node_modules` (optional).

### 2.6 Environment file

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with production values:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://kayiseit.com` (or your domain)
- `DB_*` for your production database

### 2.7 Storage and cache permissions

```bash
php artisan storage:link
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

(Replace `www-data` with the user that runs the web server if different, e.g. `nginx` or `apache`.)

### 2.8 Run migrations

```bash
php artisan migrate --force
```

### 2.9 Optimize for production

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 2.10 Point web server to `public`

- **Nginx:** `root` should be `$APP_PATH/public;`
- **Apache:** DocumentRoot should be `$APP_PATH/public` and `AllowOverride All` for that directory (so Laravel’s `public/.htaccess` works).

Restart the web server after changing config (e.g. `sudo systemctl reload nginx`).

---

## Part 3: Every new deploy (after first setup)

On your **Mac**:

1. Make changes, run `npm run build` if you commit the build (Option B).
2. Commit and push:

```bash
git add .
git commit -m "Your change description"
git push origin main
```

On the **server** (SSH in, then):

```bash
cd /var/www/kayiseit   # or your APP_PATH

git pull origin main

composer install --no-dev --optimize-autoloader

# Only if you build on server (Option A):
npm ci && npm run build

php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## Optional: One-command deploy script on server

Save this as `deploy.sh` in your project root (and add `deploy.sh` to `.gitignore` if it contains secrets, or keep it generic as below):

```bash
#!/bin/bash
set -e
cd /var/www/kayiseit   # change to your APP_PATH

git pull origin main
composer install --no-dev --optimize-autoloader
npm ci && npm run build   # omit if you commit build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
echo "Deploy done."
```

Make it executable and run it for each deploy:

```bash
chmod +x deploy.sh
./deploy.sh
```

---

## Quick checklist

| Step | Local | Server (first time) | Server (each deploy) |
|------|--------|----------------------|----------------------|
| Git | Push to `origin main` | Clone repo | `git pull` |
| Composer | — | `composer install --no-dev` | Same |
| Build | `npm run build` (if Option B) | `npm ci && npm run build` (if Option A) | Same if Option A |
| .env | — | Copy from `.env.example`, edit | — |
| Migrations | — | `php artisan migrate --force` | Same |
| Cache | — | `php artisan config/route/view cache` | Same |
| Permissions | — | `storage` & `bootstrap/cache` 775, owned by web user | — |

---

## Troubleshooting

- **500 after deploy:** Check `storage/logs/laravel.log`; fix permissions on `storage` and `bootstrap/cache`.
- **Assets 404:** Ensure `public/build/` exists (either committed or built on server) and web server serves `public/` as document root.
- **Env/config:** After changing `.env`, run `php artisan config:clear` then `php artisan config:cache`.
- **Database:** Ensure DB is reachable from the server and `.env` credentials are correct.

If you tell me your server OS and whether you use Nginx or Apache, I can give you exact config snippets for the web server and a final `deploy.sh` tailored to your path and branch.
