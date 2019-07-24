<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\TaakfaseData;
use App\Form\Handler\TaakfaseHandler;
use App\Form\Type\TaakfaseType;
use App\Service\TaakfaseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/taakfase")
 */
class TaakfaseController extends AbstractController
{
    /**
     * @var TaakfaseService
     */
    private $taakfaseService;

    public function __construct(
        string $environment,
        TaakfaseService $taakfaseService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->taakfaseService = $taakfaseService;
    }

    /**
     * @Route("/index", name="gripp_taakfase_index")
     */
    public function index(): Response
    {
        $taakfaseName = 'Taakfase';
        $taakfasesName = 'Taakfases';
        $taakfasesArray = $this->taakfaseService->getAll();

        return $this->entitiesTable($taakfaseName, $taakfasesName, $taakfasesArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_taakfase_view")
     */
    public function view(int $id): Response
    {
        $taakfaseName = 'Taakfase';
        $taakfaseArray = $this->taakfaseService->getTaakfaseByIdAsArray($id);

        return $this->entityView($taakfaseName, $taakfaseArray);
    }
    
    /**
     * @Route("/edit/{id}", name="gripp_taakfase_edit")
     */
    public function edit(int $id, TaakfaseHandler $taakfaseHandler, Request $request): Response
    {
        $taakfase = $this->taakfaseService->getTaakfaseById($id);
        $data = new TaakfaseData($taakfase);
        $form = $this->createForm(TaakfaseType::class, $data);
        
        if ($taakfaseHandler->handleRequest($form, $request, $taakfase)) {
            $this->addFlash('success', 'taakfase.message.updated');
            
            return $this->redirectToRoute('gripp_taakfase_index');
        }
        
        return $this->render('gripp/taakfase/add_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/add", name="gripp_taakfase_add")
     */
    public function create(TaakfaseHandler $taakfaseHandler, Request $request): Response
    {
        $data = new TaakfaseData();
        $form = $this->createForm(TaakfaseType::class, $data);
        
        if ($taakfaseHandler->handleRequest($form, $request)) {
            $this->addFlash('success', 'taakfase.message.added');
            
            return $this->redirectToRoute('gripp_taakfase_index');
        }
        
        return $this->render('gripp/taakfase/add_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/delete/{id}", name="gripp_taakfase_delete")
     */
    public function delete(int $id, Request $request): Response
    {
        $taakfase = $this->taakfaseService->getTaakfaseById($id);
        if ($taakfase) {
            $this->taakfaseService->deleteTaakfase($taakfase);
        }
        
        return $this->redirectToRoute('gripp_taakfase_index');
    }
}
