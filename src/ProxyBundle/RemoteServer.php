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
            $result = $this->makeRequest($requestData['url'], $requestData['method'], $requestData['params']);
            return $result;
        } else {
            // нет никакого роута для этого запроса, ничего не надо вызывать
            return null;
        }
    }

    public function makeRequest($url, $method, $params) {
        if ($method === 'GET' && count(array_keys($params))) {
            $url .= '?' . http_build_query($params);
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($method === 'POST' || $method === 'PUT' || $method === 'DELETE') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params, '&'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            switch ($method) {
                case 'POST':
                    curl_setopt($ch, CURLOPT_POST, true);
                    break;
                case 'PUT':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    break;

                case 'DELETE':
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;

            }
        }
        if (! $response = curl_exec($ch)) {
            throw new \Exception(curl_error($ch));
        }
        $info = curl_getinfo($ch);
        $code = $info['http_code'];
        curl_close($ch);
        return [
            $code,
            $response
        ];
    }
}