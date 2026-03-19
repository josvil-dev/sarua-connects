#!/bin/bash
# ─────────────────────────────────────────────────────────────
#  Sarua Connect — Xneelo (cPanel/LAMP) deployment script
#  Run this via SSH on the server after uploading files.
#  Usage:  bash deploy.sh
# ─────────────────────────────────────────────────────────────

set -e

PHP_BIN="php8.4"

find_composer() {
	if command -v composer >/dev/null 2>&1; then
		command -v composer
		return 0
	fi

	if [ -f "composer.phar" ]; then
		echo "composer.phar"
		return 0
	fi

	return 1
}

run_composer_install() {
	COMPOSER_BIN="$1"

	if [ "$COMPOSER_BIN" = "composer.phar" ]; then
		"$PHP_BIN" "$COMPOSER_BIN" install --no-dev --optimize-autoloader --no-interaction
	else
		"$COMPOSER_BIN" install --no-dev --optimize-autoloader --no-interaction
	fi
}

env_value() {
	KEY="$1"
	grep -E "^${KEY}=" .env 2>/dev/null | tail -n 1 | cut -d '=' -f2- | sed -e 's/^"//' -e 's/"$//'
}

if [ ! -f ".env" ]; then
	echo "==> [preflight] .env not found, creating from .env.example..."
	cp .env.example .env
	echo "==> [preflight] .env created. Edit .env with production DB/mail values, then run: bash deploy.sh"
	exit 1
fi

if [ ! -f "vendor/autoload.php" ]; then
	COMPOSER_BIN=""
	if COMPOSER_BIN="$(find_composer)"; then
		echo "==> [preflight] vendor missing, installing dependencies..."
		run_composer_install "$COMPOSER_BIN"
	else
		echo "ERROR: vendor/autoload.php is missing and composer is not available on this server."
		echo "Fix: upload the vendor/ folder from local machine, then run this script again."
		exit 1
	fi
fi

DB_CONNECTION_VALUE="$(env_value DB_CONNECTION)"
DB_DATABASE_VALUE="$(env_value DB_DATABASE)"

if [ "$DB_CONNECTION_VALUE" = "sqlite" ]; then
	echo "ERROR: .env is still using DB_CONNECTION=sqlite."
	echo "Update .env with your Xneelo MySQL credentials, then run: bash deploy.sh"
	exit 1
fi

if [ -z "$DB_DATABASE_VALUE" ] || [ "$DB_DATABASE_VALUE" = "your_cpanel_db_name" ]; then
	echo "ERROR: .env DB_DATABASE is not set to your real cPanel database name."
	echo "Update .env DB_DATABASE/DB_USERNAME/DB_PASSWORD, then run: bash deploy.sh"
	exit 1
fi

echo "==> [1/8] Installing PHP dependencies (no dev)..."
if COMPOSER_BIN="$(find_composer)"; then
	run_composer_install "$COMPOSER_BIN"
else
	echo "==> [1/8] Composer not found, skipping install (vendor already present)."
fi

echo "==> [2/8] Setting storage & cache permissions..."
chmod -R 775 storage bootstrap/cache
chown -R $(whoami):nobody storage bootstrap/cache 2>/dev/null || true

echo "==> [3/8] Linking public storage..."
"$PHP_BIN" artisan storage:link --force

echo "==> [4/8] Running database migrations..."
"$PHP_BIN" artisan migrate --force --no-interaction

echo "==> [5/8] Clearing old caches..."
"$PHP_BIN" artisan config:clear
"$PHP_BIN" artisan route:clear
"$PHP_BIN" artisan view:clear
"$PHP_BIN" artisan cache:clear

echo "==> [6/8] Caching config, routes and views..."
"$PHP_BIN" artisan config:cache
"$PHP_BIN" artisan route:cache
"$PHP_BIN" artisan view:cache

echo "==> [7/8] Optimizing autoloader..."
"$PHP_BIN" artisan optimize

echo "==> [8/8] Done!"
echo ""
echo "  IMPORTANT: Make sure your .env file is in place with:"
echo "    APP_ENV=production"
echo "    APP_DEBUG=false"
echo "    APP_KEY= (run: php8.2 artisan key:generate)"
echo ""
