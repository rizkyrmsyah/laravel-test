# Laravel Test App

Stack used:
- Laravel 8
- Laravel spatie enum

## Installation Requirements
- PHP 8.0+
- Mysql Database
- Composer installed in your PC

## Installation
- After clone this project run command below for installing project dependency

```bash
composer install
```
- copy `env` file by typing
```bash
cp .env.example .env
```

- Set the database connection and JWT config in `.env`
- Migrating database by typing 
```bash
php artisan migrate
```
- run the project in local environment by typing
```bash
php artisan serve
```

## Running Unit Test
Command promt / terminal in root directory of project, then type
```bash
vendor/bin/phpunit
```

## Usage

1. Import postman collection file in this project root directory to your local postman collection
2. If import finished, enjoy the API
