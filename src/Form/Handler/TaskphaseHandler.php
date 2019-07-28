<?php

namespace App\Form\Handler;

use App\Entity\Taskphase;
use App\Form\Data\TaskphaseData;
use App\Service\TaskphaseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class TaskphaseHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TaskphaseService
     */
    private $taskphaseService;

    /**
     * JoinHandler constructor.
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TaskphaseService $taskphaseService
    ) {
        $this->entityManager = $entityManager;
        $this->taskphaseService = $taskphaseService;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function handleRequest(FormInterface $form, Request $request, Taskphase $taskphase = null): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var TaskphaseData $taskphaseData */
            $taskphaseData = $form->getData();
            if ($taskphase) {
                $this->taskphaseService->updateTaskphaseWithData($taskphase, $taskphaseData);
            } else {
                $this->taskphaseService->createTaskphase($taskphaseData);
            }

            return true;
        }

        return false;
    }
}
