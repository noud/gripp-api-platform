<?php

namespace App\Service;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;

class ContactService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * @var TimelineentryService
     */
    private $timelineentryService;
    
    public function __construct(
        EntityManagerInterface $entityManager,
        ContactRepository $contactRepository,
        TimelineentryService $timelineentryService
    ) {
        $this->entityManager = $entityManager;
        $this->contactRepository = $contactRepository;
        $this->timelineentryService = $timelineentryService;
    }
    
    public function findComanyNameBySearchname(string $searchname): ?string
    {
        $contact = $this->findBySearchname($searchname);
        return $contact->getCompany()->__toString();
    }
    
    public function findBySearchname(string $searchname): ?Contact
    {
        return $this->contactRepository->findBySearchname($searchname);
    }
    
    public function updateAll()
    {
        $contactpersonen = $this->contactRepository->findAll();
        foreach ($contactpersonen as $contact) {
            $contact->setSearchname('');
            $companies = $this->timelineentryService->findCompaniesByContact($contact);
            if ($companies) {
                $companies = array_column($companies, 'companyname');
                $companiesText =  implode(PHP_EOL, $companies);
                $contact->setNotes($companiesText);
            }
            $this->contactRepository->add($contact);
        }
        $this->entityManager->flush();
    }
}
