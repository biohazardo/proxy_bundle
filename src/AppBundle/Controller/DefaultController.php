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
        $code = $request->get('remote_server_status_code');
        return $this->json([
            'message' => "Статус ответа: {$code} . Запрос к корневому урлу завершился",
            'remote_data' => $request->get('remote_server_response')
        ]);
    }

    /**
     * @Route("/post", name="postroute")
     */
    public function postAction(Request $request) {
        $code = $request->get('remote_server_status_code');
        return $this->json([
            'message' => "Статус ответа: {$code} . Запрос к /post урлу завершился. Использовался метод POST",
            'remote_data' => $request->get('remote_server_response')
        ]);

    }

    /**
     * @Route("/put", name="putroute")
     */
    public function putAction(Request $request) {
        $code = $request->get('remote_server_status_code');
        return $this->json([
            'message' => "Статус ответа: {$code} . Запрос к /put урлу завершился. Использовался метод PUT",
            'remote_data' => $request->get('remote_server_response')
        ]);

    }

    /**
     * @Route("/delete", name="deleteroute")
     */
    public function deleteAction(Request $request) {
        $code = $request->get('remote_server_status_code');
        return $this->json([
            'message' => "Статус ответа: {$code} . Запрос к /delete урлу завершился. Использовался метод DELETE",
            'remote_data' => $request->get('remote_server_response')
        ]);

    }

    /**
     * @Route("/xyz/{some_value}", name="xyzroute")
     */
    public function xyzAction(Request $request) {
        $code = $request->get('remote_server_status_code');
        return $this->json([
            'message' => "Статус ответа: {$code} . Запрос к /xyz урлу завершился. Использовался метод GET",
            'remote_data' => $request->get('remote_server_response')
        ]);

    }
}
