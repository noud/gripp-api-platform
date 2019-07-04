<?php

namespace App\Controller;

use App\Service\ContactpersoonService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ContactpersoonController extends Controller
{
    /**
     * @var ContactpersoonService
     */
    private $contactpersoonService;
    
    public function __construct(
        ContactpersoonService $contactpersoonService
    ) {
        $this->contactpersoonService = $contactpersoonService;
    }
    
    /**
     * @Route("/contactpersoons/update")
     * 
     * @ return unknown
     */
    public function updateAllAction(Request $request)
    {
        $this->contactpersoonService->updateAll();
        return new Response(
            '<html><body>Updated.</body></html>'
        );
    }
}
