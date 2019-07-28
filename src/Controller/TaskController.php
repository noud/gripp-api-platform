<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\TaskData;
use App\Form\Handler\TaskHandler;
use App\Form\Type\TaskType;
use App\Service\TaskService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/task")
 */
class TaskController extends AbstractController
{
    /**
     * @var TaskService
     */
    private $taskService;

    public function __construct(
        string $environment,
        TaskService $taskService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->taskService = $taskService;
    }

    /**
     * @Route("/index", name="gripp_task_index")
     */
    public function index(): Response
    {
        $taskName = 'Task';
        $tasksName = 'Tasks';
        $tasksArray = $this->taskService->getAll();

        return $this->entitiesTable($taskName, $tasksName, $tasksArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_task_view")
     */
    public function view(int $id): Response
    {
        $taskName = 'Task';
        $taskArray = $this->taskService->getEntityByIdAsArray($id);

        return $this->entityView($taskName, $taskArray);
    }
    
    /**
     * @Route("/delete/{id}", name="gripp_task_delete")
     */
//     public function delete(int $id, Request $request): Response
//     {
//         $task = $this->taskService->getTaskById($id);
//         if ($task) {
//             $this->taskService->deleteTask($task);
//         }
        
//         return $this->redirectToRoute('gripp_task_index');
//     }
}
