<?php

namespace App\Entity\Api;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * ApiUser
 *
 * @ORM\Table(name="api_user")
 * @ORM\Entity
 * @UniqueEntity(fields={"username", "apiToken"})
 */
class ApiUser implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $username;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", unique=true, nullable=true)
     */
    private $apiToken;
    
    // the getter and setter methods

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function setApiToken(string $apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
        return null;
    }
    
    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    
    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->apiToken;    // ???
    }
    
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return ['ROLE_API_USER'];
    }
}
