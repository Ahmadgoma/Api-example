# Laravel Sample API with Resource
This is a Laravel app using Docker for development, testing, and deployment. The app contains APIs for a Post model.

# Requirements
- Docker
- Docker Compose

# Installation

1- Clone the repository:

`git clone https://github.com/Ahmadgoma/Api-example.git`


2- Copy the .env.example file to .env:

`cp .env.example .env`

3- Build the Docker images:

`docker-compose build`

4- Start the Docker containers:

`docker-compose up -d`

5- Install the app dependencies:

`docker exec php-container composer install`

6- Generate a new app key:

`docker exec php-container php artisan key:generate`

7- Run the database migrations:

`docker exec php-container php artisan migrate --seed`

8- Run Testing:

`docker exec php-container php artisan test`

--------------------------------------------------------------------------
#APIs

1-Get all posts

Request

http

```
GET /api/posts HTTP/1.1
Host: localhost:8070
```

or

```
GET /api/posts?page=2 HTTP/1.1
Host: localhost:8070
```

Response

json

```
[
{
"id": 1,
"name": "My First Post",
"content": "This is my first post.",
"created_at": "2022-01-01T00:00:00.000000Z",
"updated_at": "2022-01-01T00:00:00.000000Z"
}, 
{
"id": 2,
"name": "My Second Post",
"content": "This is my second post.",
"created_at": "2022-01-02T00:00:00.000000Z",
"updated_at": "2022-01-02T00:00:00.000000Z"
}
]
```

2- Get a post by ID

Request

http

```
GET /api/posts/1 HTTP/1.1
Host: localhost:8070
```

Response

json

```
{
"id": 1,
"name": "My First Post",
"content": "This is my first post.",
"created_at": "2022-01-01T00:00:00.000000Z",
"updated_at": "2022-01-01T00:00:00.000000Z"
}
```

3- Create a new post

Request

http

```
POST /api/posts HTTP/1.1
Host: localhost:8070
Content-Type: application/json
```

```
{
"name": "My New Post",
"content": "This is my new post.",
}
```

Response

json

```
{
"id": 3,
"name": "My New Post",
"content": "This is my new post.",
"created_at": "2022-01-03T00:00:00.000000Z",
"updated_at": "2022-01-03T00:00:00.000000Z"
}
```

4- Update an existing post

Request

http

```
PUT /api/posts/3 HTTP/1.1
Host: localhost:8070
Content-Type: application/json
```

```
{
"name": "My Updated Post",
"content": "This is my updated post."
}
```

Response

json

```
{
"Post has been updated successfully"
}
```

5- Delete a post

Request

http

```
DELETE /api/posts/3 HTTP/1.1
Host: localhost:8070
```

Response

json

```
{
"Post has been deleted successfully"
}
```