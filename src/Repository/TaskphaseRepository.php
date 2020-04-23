<?php

namespace App\Repository;

use App\Entity\Taskphase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;

class TaskphaseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Taskphase::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Taskphase $taskphase): void
    {
        $this->getEntityManager()->persist($taskphase);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
