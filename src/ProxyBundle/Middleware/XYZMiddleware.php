<?php

namespace ProxyBundle\Middleware;

class XYZMiddleware implements iMiddleware{
    public function updateRequestData (array $params) : array {
        // какая-то работа со ссылками и найденными параметрами в урле
        $params['url'] = 'http://localhost:8888/xyz/' . $params['preg_matches'][0];
        return $params;
    }
}