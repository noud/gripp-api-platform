<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\TaskphaseData;
use App\Form\Handler\TaskphaseHandler;
use App\Form\Type\TaskphaseType;
use App\Service\TaskphaseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/taskphase")
 */
class TaskphaseController extends AbstractController
{
    /**
     * @var TaskphaseService
     */
    private $taskphaseService;

    public function __construct(
        string $environment,
        TaskphaseService $taskphaseService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->taskphaseService = $taskphaseService;
    }

    /**
     * @Route("/index", name="gripp_taskphase_index")
     */
    public function index(): Response
    {
        $taskphaseName = 'Taskphase';
        $taskphasesName = 'Taskphases';
        $taskphasesArray = $this->taskphaseService->getAll();

        return $this->entitiesTable($taskphaseName, $taskphasesName, $taskphasesArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_taskphase_view")
     */
    public function view(int $id): Response
    {
        $taskphaseName = 'Taskphase';
        $taskphaseArray = $this->taskphaseService->getTaskphaseByIdAsArray($id);

        return $this->entityView($taskphaseName, $taskphaseArray);
    }
    
    /**
     * @Route("/edit/{id}", name="gripp_taskphase_edit")
     */
    public function edit(int $id, TaskphaseHandler $taskphaseHandler, Request $request): Response
    {
        $taskphase = $this->taskphaseService->getTaskphaseById($id);
        $data = new TaskphaseData($taskphase);
        $form = $this->createForm(TaskphaseType::class, $data);
        
        if ($taskphaseHandler->handleRequest($form, $request, $taskphase)) {
            $this->addFlash('success', 'taskphase.message.updated');
            
            return $this->redirectToRoute('gripp_taskphase_index');
        }
        
        return $this->render('gripp/taskphase/add_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/add", name="gripp_taskphase_add")
     */
    public function create(TaskphaseHandler $taskphaseHandler, Request $request): Response
    {
        $data = new TaskphaseData();
        $form = $this->createForm(TaskphaseType::class, $data);
        
        if ($taskphaseHandler->handleRequest($form, $request)) {
            $this->addFlash('success', 'taskphase.message.added');
            
            return $this->redirectToRoute('gripp_taskphase_index');
        }
        
        return $this->render('gripp/taskphase/add_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/delete/{id}", name="gripp_taskphase_delete")
     */
    public function delete(int $id, Request $request): Response
    {
        $taskphase = $this->taskphaseService->getTaskphaseById($id);
        if ($taskphase) {
            $this->taskphaseService->deleteTaskphase($taskphase);
        }
        
        return $this->redirectToRoute('gripp_taskphase_index');
    }
}
