
# LARAVEL 8 REST API - SAMPLE PROJECT

## Introduction

This is a sample project built using laravel 8 and adopting the repository design pattern architecture

This project have some features, such as:

- Basic user, post, comment implementation
- API Resource (Data Transfer Object)
- Service Layer (Business Logic Layer)
- Model Filter [Tucker-Eric/EloquentFilter](https://github.com/Tucker-Eric/EloquentFilter)
- Repository Design Pattern
- User Permissions and Roles [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- Events and Listeners
- Laravel Passport [documentation](https://laravel.com/docs/8.x/passport)
- Telescope [documentation](https://laravel.com/docs/8.x/telescope)
- International Phone Number Library [Propaganistas/Laravel-Phone](https://github.com/Propaganistas/Laravel-Phone)
- Exception Handling (with Custom Error Code)
- Helpers
- Multi guard with passport

## Requirements

Please meet the laravel documentation [here](https://laravel.com/docs/8.x/installation#server-requirements)

## Installation

1. Clone the repository: `git clone https://github.com/locnguyen1842/laravel8-restful-api-example.git`
2. Change to project directory ` cd laravel8-restful-api-example`
3. Install dependencies: `composer install`
4. Make a .env: `cp .env.example .env` (then add database information)
5. Generate an app encryption key: `php artisan key:generate`
5. Migrate and Seed the database : `php artisan migrate --seed`
