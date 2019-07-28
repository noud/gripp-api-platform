<?php

namespace App\Controller;

use App\Service\ContactService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @var ContactService
     */
    private $contactService;
    
    public function __construct(
        ContactService $contactService
    ) {
        $this->contactService = $contactService;
    }
    
    /**
     * @Route("/contacts/update")
     * 
     * @ return unknown
     */
    public function updateAllAction(Request $request)
    {
        $this->contactService->updateAll();
        return new Response(
            '<html><body>Updated.</body></html>'
        );
    }
}
