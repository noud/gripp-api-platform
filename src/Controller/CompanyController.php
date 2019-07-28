<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Form\Data\CompanyData;
use App\Form\Handler\CompanyHandler;
use App\Form\Type\CompanyType;
use App\Service\CompanyService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/gripp/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @var CompanyService
     */
    private $companyService;

    public function __construct(
        string $environment,
        CompanyService $companyService
    ) {
        if ('dev' !== $environment) {
            throw $this->createAccessDeniedException('GET OUT!');
        }
        $this->companyService = $companyService;
    }

    /**
     * @Route("/index", name="gripp_company_index")
     */
    public function index(): Response
    {
        $companyName = 'Company';
        $companysName = 'Companys';
        $companysArray = $this->companyService->getAll();
        //dump($companysArray);die();
        return $this->entitiesTable($companyName, $companysName, $companysArray);
    }

    /**
     * @Route("/view/{id}", name="gripp_company_view")
     */
    public function view(int $id): Response
    {
        $companyName = 'Company';
        $companyArray = $this->companyService->getEntityByIdAsArray($id);

        return $this->entityView($companyName, $companyArray);
    }
}
