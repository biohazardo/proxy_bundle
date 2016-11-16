<?php

namespace ProxyBundle;
use Symfony\Component\Config\Definition\Exception\Exception;
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
        foreach($this->routes as $route) {
            // путь должен быть заполнени, либо регулярное выражение
            if (empty($route['regexp']) && empty($route['path'])) {
                throw new \Exception("Need to defined regexp of path for route");
            }
            // должен быть адрес, либо же middleware
            if (empty($route['middleware']) && empty($route['address'])) {
                throw new \Exception("Need to define address or middleware for route");
            }
            $relevant = false; // признак подходящего маршрута
            if (!empty($route['path']) && $path === $route['path']) {
                $relevant = true;
            } else if (!empty($route['regexp'])) {
                throw new \Exception('Regexp not implemented now');
            }
            if ($relevant) {
                // Маршрут подходит
                $address = $route['address'];
                if (!empty($address)) {
                    return [
                        'url' => $address,
                        'method' => $method,
                        'params' => $params
                    ];
                } else if (!empty($route['middleware'])) {
                    // middleware модифицирует параметры
                    $className = $route['middleware'];
                    $middleware = new $className();
                    return $middleware->makeRequest($path, $method, $params); // middleware подготовит данные
                }
            }
        }
        return null; // не подшел ни один маршрут
    }
}