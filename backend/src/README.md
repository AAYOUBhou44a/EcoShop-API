# EcoShop API (Laravel API-first)

API REST e-commerce avec Laravel + Sanctum, Events/Listeners, Queues, et tests Pest.

## Stack
- Laravel API-first
- PostgreSQL
- Laravel Sanctum (token API)
- Queues (database/redis)
- Pest

## Installation
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
```

## Run API
```bash
php artisan serve
```

## Queue configuration
Dans `.env`:
```env
QUEUE_CONNECTION=database
```
Puis :
```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

## Run tests
```bash
php artisan test
```

## Architecture
- Auth Sanctum: register/login/logout/me
- Catalog: products/categories
- Cart: add/update/remove/list items
- Order checkout: dispatch `OrderPlaced`
- Async listeners/jobs:
  - Send order confirmation email
  - Update product stock

## Security
- Middleware `auth:sanctum` sur routes protégées
- Validation dédiée via `FormRequest`
- Contrôle admin via `is_admin`
- Codes HTTP et erreurs JSON cohérents

## API Documentation
Voir `docs/api.md` et `docs/postman_collection.json`.
