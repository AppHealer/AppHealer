#!/bin/bash

cd /var/www


cp .env.docker .env
composer install
chmod 666 .env


php artisan key:generate

php artisan apphealer:utils:waitfordb

php artisan migrate --force

crontab /etc/crontab
cron

/usr/bin/supervisord -n -c /etc/supervisord.conf

