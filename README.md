Symfony Proxy Bundle
====

How to use it:

- Clone this repo

- Execute command to start node js server (fake remote server)
```
    cd remoteserver
    npm install
    node index.js
```
Node server will be started.

- in another terminal instance in root project path
```
    php bin/console server:run
```
Symfony will be started

- Use postman to test these routes:
```
    GET localhost:8000
    POST localhost:8000/post
    PUT localhost:8000/put
    DELETE localhost:8000/delete
    GET localhost:8000/xyz/123456
```
You will see JSON-result from remote server and from local controller action.

- You can create any middleware and use it in routes

- You can use your own routes, using strings or regular expressions

### Some information
- Proxy can handle 4 http methods: GET, POST, PUT, DELETE.
- Routes for proxy can be configured in /src/ProxyBundle/config/config.yml
- You can use middleware and write custom code to route request. Middlewares are in /src/ProxyBundle/Middleware folder




