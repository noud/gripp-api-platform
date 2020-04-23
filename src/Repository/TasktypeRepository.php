<?php

namespace App\Repository;

use App\Entity\Tasktype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;

class TasktypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tasktype::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Tasktype $tasktype): void
    {
        $this->getEntityManager()->persist($tasktype);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
