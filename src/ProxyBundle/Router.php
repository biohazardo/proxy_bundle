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
            $pregMatches = null; // если будет проверка по соответствиям, то их надо запомнить, и передать в middleware
            $relevant = false; // признак подходящего маршрута
            if (!empty($route['path']) && $path === $route['path']) {
                $relevant = true;
            } else if (!empty($route['regexp'])) {
//                $regexp = preg_quote($route['regexp']);
                $count = preg_match_all($route['regexp'], $path, $matches);
                if ($count > 0) {
                    $relevant = true;
                }
                $pregMatches = $matches[1];
            }
            if ($relevant) {
                // Маршрут подходит
                if (!empty($route['address'])) {
                    return [
                        'url' => $route['address'],
                        'method' => $method,
                        'params' => $params
                    ];
                } else if (!empty($route['middleware'])) {
                    // middleware модифицирует параметры
                    $className = $route['middleware'];
                    $middleware = new $className();
                    return $middleware->updateRequestData([
                        'url' => !empty($route['address']) ? $route['address'] : null,
                        'method' => $method,
                        'params' => $params,
                        'preg_matches' => $pregMatches
                    ]); // middleware подготовит данные
                }
            }
        }
        return null; // не подшел ни один маршрут
    }
}