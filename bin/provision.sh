#!/usr/bin/env sh
composer install
npm install
node_modules/.bin/encore dev
./generate.sh
bin/console doctrine:migrations:migrate