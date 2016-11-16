Symfony Proxy Bundle
====

How to use it:

1. Clone this repo

2. Execute command
```
    cd remoteserver
    npm install
    node index.js
```
Node server will be started.

2. in another terminal instance in root project path
```
    php bin/console server:run
```
Symfony will be started

3. Use postman to test these routes:
```
    GET localhost:8000
    POST localhost:8000/post
    PUT localhost:8000/put
    DELETE localhost:8000/delete
    GET localhost:8000/xyz/123456
```
You will see JSON-result from remote server and from local controller action.

4. You can create any middleware and use it in routes

5. You can use your own routes, using strings or regular expressions

### Some information
- Proxy can handle 4 http methods: GET, POST, PUT, DELETE.
- Routes for proxy can be configured in /src/ProxyBundle/config/config.yml
- You can use middleware and write custom code to route request. Middlewares in /src/ProxyBundle/Middleware folder
-


