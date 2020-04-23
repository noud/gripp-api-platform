<?php

namespace App\Repository;

use App\Entity\Employee as User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;

class EmployeeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findByEmail(string $userEmail): ?User
    {
        /** @var User $user */
        $user = $this->findOneBy([
            'email' => $userEmail,
        ]);

        return $user;
    }
}
