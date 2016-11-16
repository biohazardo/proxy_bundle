<?php

namespace ProxyBundle;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class Router
 * @package ProxyBundle
 */
class Router
{
    private $routes;
    public function __construct(Container $container)
    {
        $this->routes = $container->getParameterBag()->get('proxy_routes');
    }

    public function getRequestParams(string $path, string $method, array $params):array {
        $url = $this->getRelevantUrl($path, $method, $params);
        return [
            'url' => '',
            'method' => $method,
            'params' => $params
        ];
    }

    protected function getRelevantUrl(string $path, string $method, array $params) : string {
        print_r($this->routes);
        return '';
    }
}