<?php

namespace App\Repository;

use App\Entity\Taakfase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TaakfaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Taakfase::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Taakfase $taakfase): void
    {
        $this->getEntityManager()->persist($taakfase);
    }
}
