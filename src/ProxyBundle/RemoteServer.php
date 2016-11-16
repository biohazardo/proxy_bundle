<?php

namespace ProxyBundle;


use Symfony\Component\DependencyInjection\Container;

class RemoteServer
{
    /**
     * @var Router
     */
    protected $router;

    public function __construct(Container $container, Router $router)
    {
        $this->router = $router;
    }


    public function handleRequest(string $path, $method, $params)
    {
        // По следующим параметрам определяет параметры будущего запроса
        $requestData = $this->router->getRequestParams($path, $method, $params);
        if ($requestData) {
//            $response = $this->makeRequest($requestData->url, $requestData->method, $requestData->params);
        } else {
            // нет никакого роута для этого запроса, ничего не надо вызывать
            return null;
        }

        return 'fake result';

    }
}