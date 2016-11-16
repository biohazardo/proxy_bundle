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
        return $this->json([
            'message' => 'Запрос к корневому урлу удачно завершился',
            'remote_data' => $request->get('remote_server_response')
        ]);
    }

    /**
     * @Route("/post", name="postroute")
     */
    public function postAction(Request $request) {
        return $this->json([
            'message' => 'Запрос к /post урлу удачно завершился. Использовался метод POST',
            'remote_data' => $request->get('remote_server_response')
        ]);

    }

    /**
     * @Route("/put", name="putroute")
     */
    public function putAction(Request $request) {
        return $this->json([
            'message' => 'Запрос к /put урлу удачно завершился. Использовался метод PUT',
            'remote_data' => $request->get('remote_server_response')
        ]);

    }

    /**
     * @Route("/delete", name="deleteroute")
     */
    public function deleteAction(Request $request) {
        return $this->json([
            'message' => 'Запрос к /delete урлу удачно завершился. Использовался метод DELETE',
            'remote_data' => $request->get('remote_server_response')
        ]);

    }
}
