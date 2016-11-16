<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        print_r($request->get('remote_server_response'));
        return $this->json([]);
    }

    /**
     * @Route("/test", name="testroute")
     */
    public function testAction(Request $request) {
        print_r($request->get('remote_server_response'));
        return $this->json(['test']);
    }
}
