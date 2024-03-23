#!/bin/bash
set -e

PHP_ERROR_REPORTING=${PHP_ERROR_REPORTING:-"E_ALL & ~E_DEPRECATED & ~E_NOTICE"}
sed -ri 's/^display_errors\s*=\s*Off/display_errors = On/g' /etc/php//apache2/php.ini
sed -ri 's/^display_errors\s*=\s*Off/display_errors = On/g' /etc/php//cli/php.ini
sed -ri "s/^error_reporting\s*=.*$//g" /etc/php//apache2/php.ini
sed -ri "s/^error_reporting\s*=.*$//g" /etc/php//cli/php.ini
echo -e "\nerror_reporting = $PHP_ERROR_REPORTING" >> /etc/php//apache2/php.ini
echo -e "\nerror_reporting = $PHP_ERROR_REPORTING" >> /etc/php//cli/php.ini

cd /var/www/html
composer install

# Run Apache
source /etc/apache2/envvars && exec /usr/sbin/apache2 -DFOREGROUND