<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\BedrijfData;
use App\Form\Handler\BedrijfHandler;
use App\Form\Type\BedrijfType;
use App\Service\BedrijfService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/bedrijf")
 */
class BedrijfController extends AbstractController
{
    /**
     * @var BedrijfService
     */
    private $bedrijfService;

    public function __construct(
        string $environment,
        BedrijfService $bedrijfService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->bedrijfService = $bedrijfService;
    }

    /**
     * @Route("/index", name="gripp_bedrijf_index")
     */
    public function index(): Response
    {
        $bedrijfName = 'Bedrijf';
        $bedrijfsName = 'Bedrijfs';
        $bedrijfsArray = $this->bedrijfService->getAll();
        //dump($bedrijfsArray);die();
        return $this->entitiesTable($bedrijfName, $bedrijfsName, $bedrijfsArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_bedrijf_view")
     */
    public function view(int $id): Response
    {
        $bedrijfName = 'Bedrijf';
        $bedrijfArray = $this->bedrijfService->getEntityByIdAsArray($id);

        return $this->entityView($bedrijfName, $bedrijfArray);
    }
}
