<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Task $task): void
    {
//         dump('BEFORE: ');
//         dump($task);
        $tasktype = $task->getType();
        $taskfase = $task->getPhase();
        $bedrijf = $task->getCompany();
        $task->setType(null);
        $task->setPhase(null);
        $task->setCompany(null);
        $this->getEntityManager()->persist($task);
        
        $task->setId($task->getId());
        if ($tasktype) {
            $tasktype = $this->getEntityManager()->merge($tasktype);
            $task->setType($tasktype);
        }
        if ($taskfase) {
            $taskfase = $this->getEntityManager()->merge($taskfase);
            $task->setPhase($taskfase);
        }
        if ($bedrijf) {
            $bedrijf = $this->getEntityManager()->merge($bedrijf);
            $task->setCompany($bedrijf);
        }
        $this->getEntityManager()->persist($task);
//         dump('AFTER: ');
//         dump($task);
    }
    
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
