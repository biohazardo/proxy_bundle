<?php

namespace ProxyBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ProxyListener {
    public function onKernelRequest(GetResponseEvent $event) {
        $request = $event->getRequest();
        $request->attributes->set('remote_server_response', 'something here');
    }
}