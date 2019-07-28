<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\TasktypeData;
use App\Form\Handler\TasktypeHandler;
use App\Form\Type\TasktypeType;
use App\Service\TasktypeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/tasktype")
 */
class TasktypeController extends AbstractController
{
    /**
     * @var TasktypeService
     */
    private $tasktypeService;

    public function __construct(
        string $environment,
        TasktypeService $tasktypeService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->tasktypeService = $tasktypeService;
    }

    /**
     * @Route("/index", name="gripp_tasktype_index")
     */
    public function index(): Response
    {
        $tasktypeName = 'Tasktype';
        $tasktypesName = 'Tasktypes';
        $tasktypesArray = $this->tasktypeService->getAll();
        //dump($tasktypesArray);
        return $this->entitiesTable($tasktypeName, $tasktypesName, $tasktypesArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_tasktype_view")
     */
    public function view(int $id): Response
    {
        $tasktypeName = 'Tasktype';
        $tasktypeArray = $this->tasktypeService->getTasktypeByIdAsArray($id);

        return $this->entityView($tasktypeName, $tasktypeArray);
    }
    
    /**
     * @Route("/delete/{id}", name="gripp_tasktype_delete")
     */
    public function delete(int $id, Request $request): Response
    {
        $tasktype = $this->tasktypeService->getTasktypeById($id);
        if ($tasktype) {
            $this->tasktypeService->deleteTasktype($tasktype);
        }
        
        return $this->redirectToRoute('gripp_tasktype_index');
    }
}
