# Backend Task

## Build a RESTful-API ecosystem for to-do list with Laravel, PHP 7.2, Nginx, MySQL.

### DB schema fields
`id`, `title`, `content`, `attachment`, `created_at`, `done_at`, `deleted_at`

### Minimum Requirments

1. JSON-API like response and JSON payload or multipart for requests
2. API that modifies data *must* be protected by tokens
3. Tokens can be self-designed or JWT token
4. Design DB schema by your self

### Optional

1. Optimize performance /w some other technologies
2. Create a local dev environment using Docker
3. Tokens with TTL
4. Tokens with RefreshToken

### API List

* get all to-do lists
* get one to-do list
* create one to-do list
* update one to-do list
* delete one to-do list
* delete all to-do list
* generate a new token
* get token status (Only if tokens with TTL or RefreshToken)

### Notice

Please upload your source code to GitHub or other similar service

### Installation

```shell
# git clone
git clone git@github.com:danielhuang-030/api_test.git

# composer install
composer install

# copy .env and setting db
cp .env.example .env
vi .env

# modify folders permissions
chmod 777 -R storage
chmod 777 -R bootstrap/cache

# migrate, and insert db seed
php artisan migrate
php artisan db:seed
```

### API info

* create one to-do list
  * POST /api/todo/1
    * Authorization: Bearer [api_token]
    * Content-Type: multipart/form-data

* update one to-do list
  * PUT/PATCH /api/todo/1
    * Authorization: Bearer [api_token]
    * Content-Type: application/x-www-form-urlencoded

* get all to-do lists
  * GET /api/todo
    * Authorization: Bearer [api_token]

* get one to-do list
  * GET /api/todo/1
    * Authorization: Bearer [api_token]

* delete one to-do list
  * DELETE /api/todo/1
    * Authorization: Bearer [api_token]

* delete all to-do list
  * DELETE /api/todo/destroy_all
    * Authorization: Bearer [api_token]

* generate a new token
  * PUT /api/todo/update_token
    * Authorization: Bearer [api_token]
