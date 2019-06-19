<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TagRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tag::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Tag $tag): void
    {
        $this->getEntityManager()->persist($tag);
    }
}
