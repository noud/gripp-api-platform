<?php

namespace App\Form\Handler;

use App\Entity\Taakfase;
use App\Form\Data\TaakfaseData;
use App\Service\TaakfaseService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class TaakfaseHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TaakfaseService
     */
    private $taakfaseService;

    /**
     * JoinHandler constructor.
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TaakfaseService $taakfaseService
    ) {
        $this->entityManager = $entityManager;
        $this->taakfaseService = $taakfaseService;
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function handleRequest(FormInterface $form, Request $request, Taakfase $taakfase = null): bool
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var TaakfaseData $taakfaseData */
            $taakfaseData = $form->getData();
            if ($taakfase) {
                $this->taakfaseService->updateTaakfase($taakfase, $taakfaseData);
            } else {
                $this->taakfaseService->createTaakfase($taakfaseData);
            }

            return true;
        }

        return false;
    }
}
