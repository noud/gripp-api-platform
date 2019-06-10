<?php

namespace App\Security;

use App\Entity\Medewerker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $email
     */
    public function loadUserByUsername($username): Medewerker
    {
        $user = $this->findOneUserBy(['username' => $username]);

        if (!$user) {
            throw new UsernameNotFoundException();
        }

        return $user;
    }

    /**
     * @param array $options
     */
    private function findOneUserBy($options)
    {
        /** @var User $user */
        $user = $this->entityManager
            ->getRepository(Medewerker::class)
            ->findOneBy($options);

        return $user;
    }

    public function refreshUser(UserInterface $user): ?Medewerker
    {
        if (!$user instanceof Medewerker) {
            throw new UnsupportedUserException();
        }

        if (null === $reloadedUser = $this->findOneUserBy(['id' => $user->getId()])) {
            throw new UsernameNotFoundException();
        }

        return $reloadedUser;
    }

    /**
     * @param string $class
     */
    public function supportsClass($class): bool
    {
        return User::class === $class;
    }
}
