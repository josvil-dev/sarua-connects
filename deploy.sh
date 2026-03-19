#!/bin/bash
# ─────────────────────────────────────────────────────────────
#  Sarua Connect — Xneelo (cPanel/LAMP) deployment script
#  Run this via SSH on the server after uploading files.
#  Usage:  bash deploy.sh
# ─────────────────────────────────────────────────────────────

set -e

echo "==> [1/8] Installing PHP dependencies (no dev)..."
php8.2 $(which composer) install --no-dev --optimize-autoloader --no-interaction

echo "==> [2/8] Setting storage & cache permissions..."
chmod -R 775 storage bootstrap/cache
chown -R $(whoami):nobody storage bootstrap/cache 2>/dev/null || true

echo "==> [3/8] Linking public storage..."
php8.2 artisan storage:link --force

echo "==> [4/8] Running database migrations..."
php8.2 artisan migrate --force --no-interaction

echo "==> [5/8] Clearing old caches..."
php8.2 artisan config:clear
php8.2 artisan route:clear
php8.2 artisan view:clear
php8.2 artisan cache:clear

echo "==> [6/8] Caching config, routes and views..."
php8.2 artisan config:cache
php8.2 artisan route:cache
php8.2 artisan view:cache

echo "==> [7/8] Optimizing autoloader..."
php8.2 artisan optimize

echo "==> [8/8] Done!"
echo ""
echo "  IMPORTANT: Make sure your .env file is in place with:"
echo "    APP_ENV=production"
echo "    APP_DEBUG=false"
echo "    APP_KEY= (run: php8.2 artisan key:generate)"
echo ""
