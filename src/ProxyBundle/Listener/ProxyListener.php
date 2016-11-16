<?php

namespace ProxyBundle\Listener;

use ProxyBundle\RemoteServer;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ProxyListener {

    private $remote_server;
    public function __construct(Container $container, RemoteServer $remoteServer)
    {
        $this->remote_server = $remoteServer;

    }

    public function onKernelRequest(GetResponseEvent $event) {
        /**
         * Вмешиваемся в запрос пользователя, добавляя туда свои данные, которые мы получили от стороннего сервера
         */
        $request = $event->getRequest();
        $uri = $request->getPathInfo();

        // Параметры запроса
        if ($request->getMethod() === 'GET') {
            $params = $request->query->all();
        } else if (in_array($request->getMethod(), ['POST', 'PUT', 'DELETE'])) {
            $params = $request->request->all();
        }
        $response = $this->remote_server->handleRequest($uri, $request->getMethod(), $params);
        if ($response) {
            $request->attributes->set('remote_server_response', $response);
        }
    }
}