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
 * @UniqueEntity(fields={"username", "apiToken", "apiJWTToken"})
 */
class ApiTokenUser implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    protected $username;
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected $password;
    
    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @var string|null
     */
    protected $plainPassword;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, nullable=true)
     */
    protected $apiToken;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", unique=true, nullable=true)
     */
    protected $apiJWTToken;
    
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
    
    public function getApiJWTToken(): string
    {
        return $this->apiJWTToken;
    }
    
    public function setApiJWTToken(string $apiJWTToken)
    {
        $this->apiJWTToken = $apiJWTToken;
    }
    
    /**
     * Symfony UserInterface
     */
    
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return ['ROLE_API_USER'];
    }
    
    /**
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->apiToken;
    }
    
    public function setPassword(string $password): self
    {
        $this->password = $password;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    
    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(?string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
        // forces the object to look "dirty" to Doctrine. Avoids
        // Doctrine *not* saving this entity, if only plainPassword changes
        $this->password = null;
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
    
    public function __toString(): string
    {
        return $this->getUsername();
    }
}
