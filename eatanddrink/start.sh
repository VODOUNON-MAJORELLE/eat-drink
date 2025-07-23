#!/bin/bash

chmod -R 775 storage bootstrap/cache

if ! grep -q "APP_KEY=base64" .env; then
    php artisan key:generate
fi

php artisan storage:link

php artisan migrate --force

php artisan serve --host=0.0.0.0 --port=$PORT
