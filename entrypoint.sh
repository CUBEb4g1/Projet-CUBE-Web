#!/bin/bash
. ~/.nvm/nvm.sh && \
npm install && \
npm run dev
php artisan migrate
composer install
php artisan serve --host=0.0.0.0