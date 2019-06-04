#!/usr/bin/env sh
composer install
bin/phpunit install
bin/phpunit
# ./var/phpcs/
vendor/bin/php-cs-fixer fix
php -d memory_limit=4G vendor/bin/phpstan analyse src tests --level max
vendor/bin/phpmd src text phpmd.xml
#vendor/bin/phpmd src/Entity/ text phpmd-entities.xml
#vendor/bin/phpmd src/Gripp/Entity/ text phpmd-entities.xml
bin/console lint:twig templates
bin/console security:check