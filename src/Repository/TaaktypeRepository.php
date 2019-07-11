<?php

namespace App\Repository;

use App\Entity\Taaktype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TaaktypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Taaktype::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Taaktype $taaktype): void
    {
        $this->getEntityManager()->persist($taaktype);
    }
}
