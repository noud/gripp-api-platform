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
     * @ORM\Column(type="string", unique=true)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $apiToken;
    
    // the getter and setter methods

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param mixed $apiToken
     */
    public function setApiToken($apiToken)
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
