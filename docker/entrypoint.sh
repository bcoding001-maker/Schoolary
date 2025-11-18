#!/usr/bin/env bash
set -euo pipefail

cd /app

echo "[entrypoint] Running Laravel optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache || true

if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    echo "[entrypoint] Running database migrations..."
    php artisan migrate --force --verbose
fi

exec "$@"
