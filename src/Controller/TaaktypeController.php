<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\TaaktypeData;
use App\Form\Handler\TaaktypeHandler;
use App\Form\Type\TaaktypeType;
use App\Service\TaaktypeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/taaktype")
 */
class TaaktypeController extends AbstractController
{
    /**
     * @var TaaktypeService
     */
    private $taaktypeService;

    public function __construct(
        string $environment,
        TaaktypeService $taaktypeService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->taaktypeService = $taaktypeService;
    }

    /**
     * @Route("/index", name="gripp_taaktype_index")
     */
    public function index(): Response
    {
        $taaktypeName = 'Taaktype';
        $taaktypesName = 'Taaktypes';
        $taaktypesArray = $this->taaktypeService->allTaaktypes();
        //dump($taaktypesArray);
        return $this->entitiesTable($taaktypeName, $taaktypesName, $taaktypesArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_taaktype_view")
     */
    public function view(int $id): Response
    {
        $taaktypeName = 'Taaktype';
        $taaktypeArray = $this->taaktypeService->getTaaktypeByIdAsArray($id);

        return $this->entityView($taaktypeName, $taaktypeArray);
    }
    
    /**
     * @Route("/delete/{id}", name="gripp_taaktype_delete")
     */
    public function delete(int $id, Request $request): Response
    {
        $taaktype = $this->taaktypeService->getTaaktypeById($id);
        if ($taaktype) {
            $this->taaktypeService->deleteTaaktype($taaktype);
        }
        
        return $this->redirectToRoute('gripp_taaktype_index');
    }
}
