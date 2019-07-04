<?php

namespace App\Service;

use App\Entity\Contactpersoon;
use App\Repository\ContactpersoonRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactpersoonService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     * @var ContactpersoonRepository
     */
    private $contactpersoonRepository;

    /**
     * @var TimelineentryService
     */
    private $timelineentryService;
    
    public function __construct(
        EntityManagerInterface $entityManager,
        ContactpersoonRepository $contactpersoonRepository,
        TimelineentryService $timelineentryService
    ) {
        $this->entityManager = $entityManager;
        $this->contactpersoonRepository = $contactpersoonRepository;
        $this->timelineentryService = $timelineentryService;
    }
    
    public function findComanyNameBySearchname(string $searchname): ?string
    {
        $contactpersoon = $this->findBySearchname($searchname);
        return $contactpersoon->getCompany()->__toString();
    }
    
    public function findBySearchname(string $searchname): ?Contactpersoon
    {
        return $this->contactpersoonRepository->findBySearchname($searchname);
    }
    
    public function updateAll()
    {
        $contactpersonen = $this->contactpersoonRepository->findAll();
        foreach ($contactpersonen as $contactpersoon) {
            $contactpersoon->setSearchname('');
            $companies = $this->timelineentryService->findCompaniesByContact($contactpersoon);
            if ($companies) {
                $companies = array_column($companies, 'companyname');
                $companiesText =  implode(PHP_EOL, $companies);
                $contactpersoon->setNotes($companiesText);
            }
            $this->contactpersoonRepository->add($contactpersoon);
        }
        $this->entityManager->flush();
    }
}
