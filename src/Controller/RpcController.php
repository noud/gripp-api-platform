<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RpcController extends Controller
{
    /**
     * @Route("/public/api3.php", methods={"POST"})
     * 
     * @ return unknown
     */
    public function indexAction(Request $request)
    {
        //return $this->get('rpc.server.http_handler.default')->handleHttpRequest($request);
        return $this->get('rpc.server.http_handler.v3')->handleHttpRequest($request);
    }
}
