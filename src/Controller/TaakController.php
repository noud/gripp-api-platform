<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\TaakData;
use App\Form\Handler\TaakHandler;
use App\Form\Type\TaakType;
use App\Service\TaakService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/taak")
 */
class TaakController extends AbstractController
{
    /**
     * @var TaakService
     */
    private $taakService;

    public function __construct(
        string $environment,
        TaakService $taakService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->taakService = $taakService;
    }

    /**
     * @Route("/index", name="gripp_taak_index")
     */
    public function index(): Response
    {
        $taakName = 'Taak';
        $taaksName = 'Taaks';
        $taaksArray = $this->taakService->getAll();

        return $this->entitiesTable($taakName, $taaksName, $taaksArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_taak_view")
     */
    public function view(int $id): Response
    {
        $taakName = 'Taak';
        $taakArray = $this->taakService->getEntityByIdAsArray($id);

        return $this->entityView($taakName, $taakArray);
    }
    
    /**
     * @Route("/delete/{id}", name="gripp_taak_delete")
     */
//     public function delete(int $id, Request $request): Response
//     {
//         $taak = $this->taakService->getTaakById($id);
//         if ($taak) {
//             $this->taakService->deleteTaak($taak);
//         }
        
//         return $this->redirectToRoute('gripp_taak_index');
//     }
}
