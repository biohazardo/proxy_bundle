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
            $response = $this->makeRequest($requestData['url'], $requestData['method'], $requestData['params']);
            return $response;
        } else {
            // нет никакого роута для этого запроса, ничего не надо вызывать
            return null;
        }
    }

    public function makeRequest($url, $method, $params) {
        if ($method === 'GET') {
            $url .= '?' . http_build_query($params);
        }
        $ch = curl_init($url);
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        if (! $response = curl_exec($ch)) {
            throw new \Exception(curl_error($ch));
        }
        curl_close($ch);
        return $response;
    }
}