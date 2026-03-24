# API Endpoints

Base URL: `/api/v1`

## Auth
- `POST /auth/register`
- `POST /auth/login`
- `GET /auth/me` (auth)
- `POST /auth/logout` (auth)

## Public catalog
- `GET /products?category_id=&category_slug=&per_page=`
- `GET /products/{product}`
- `GET /categories`

## Cart (auth)
- `GET /cart`
- `POST /cart/items`
- `PUT /cart/items/{cartItem}`
- `DELETE /cart/items/{cartItem}`

## Orders (auth)
- `GET /orders`
- `POST /orders`

## Admin (auth + is_admin)
- `POST /admin/products`
- `PUT /admin/products/{product}`
- `DELETE /admin/products/{product}`
- `POST /admin/categories`
- `PUT /admin/categories/{category}`
- `DELETE /admin/categories/{category}`
