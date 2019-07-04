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

    public function __construct(
        EntityManagerInterface $entityManager,
        ContactpersoonRepository $contactpersoonRepository
    ) {
        $this->entityManager = $entityManager;
        $this->contactpersoonRepository = $contactpersoonRepository;
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
            $this->contactpersoonRepository->add($contactpersoon);
        }
        $this->entityManager->flush();
    }
}
