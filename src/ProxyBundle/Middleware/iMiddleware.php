<?php

namespace ProxyBundle\Middleware;

interface iMiddleware {
    public function updateRequestData (array $params) : array;
} 