#!/bin/sh
set -eu

cd /var/www/html

mkdir -p \
    storage/app/public \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

if [ -z "${APP_KEY:-}" ]; then
    key_file="storage/app/.docker-app-key"

    if [ ! -s "$key_file" ]; then
        umask 077
        php artisan key:generate --show --no-ansi > "$key_file"
    fi

    APP_KEY="$(tr -d '\r\n' < "$key_file")"
    export APP_KEY
fi

# Keep the resolved key in a minimal runtime dotenv file so the web process and
# `artisan test` use the same key without baking a secret into the image.
umask 077
printf 'APP_KEY=%s\n' "$APP_KEY" > .env

if [ "${DB_CONNECTION:-}" = "mysql" ]; then
    attempts=0

    until php -r '
        try {
            new PDO(
                sprintf("mysql:host=%s;port=%s;dbname=%s", getenv("DB_HOST"), getenv("DB_PORT"), getenv("DB_DATABASE")),
                getenv("DB_USERNAME"),
                getenv("DB_PASSWORD"),
            );
        } catch (Throwable $exception) {
            exit(1);
        }
    '; do
        attempts=$((attempts + 1))

        if [ "$attempts" -ge 30 ]; then
            echo "MySQL did not become ready in time." >&2
            exit 1
        fi

        echo "Waiting for MySQL... ($attempts/30)"
        sleep 2
    done
fi

if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
    php artisan migrate --force
fi

php artisan storage:link --no-interaction >/dev/null 2>&1 || true

exec "$@"
