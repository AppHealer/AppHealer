#!/bin/bash

cd /var/www


cp .env.docker .env
composer install --no-dev
chmod 666 .env


php artisan key:generate

php artisan apphealer:utils:waitfordb

php artisan migrate --force
php artisan route:cache

crontab /etc/crontab
cron

/usr/bin/supervisord -n -c /etc/supervisord.conf

