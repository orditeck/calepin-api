# Calepin API

## Installation

Requirements:
* PHP >= 7.1.3
  * OpenSSL
  * PDO
  * Mbstring
  * Tokenizer
  * XML
  * Ctype
  * JSON
* MySQL >= 5.7.7

```
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## Good to know / remember

- `php artisan db:drop-tables --force --yes` is useful when testing 
migration/seeding in a dev environment
- `php artisan db:drop-tables --force --yes && php artisan migrate && php artisan db:seed` 
is also useful right now when testing new seed