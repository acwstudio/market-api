#!/bin/sh

set -e

if [[ -z $1 ]]; then
  echo >&2 'error: missing parameter environment name in migrate.sh'
  exit 1
fi

/wait-for-it.sh -h "${DB_HOST}" -p "${DB_PORT}" -t 600

cd /var/www/html

php artisan route:clear
php artisan optimize:clear