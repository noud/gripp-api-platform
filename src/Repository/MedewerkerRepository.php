<?php

namespace App\Repository;

use App\Entity\Medewerker as User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class MedewerkerRepository extends ServiceEntityRepository
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
