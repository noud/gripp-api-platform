<?php

namespace App\Repository;

use App\Entity\Contactpersoon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ContactpersoonRepository extends ServiceEntityRepository
{
    
    public function findBySearchname(string $searchname): ?Contactpersoon
    {
        /** @var Contactpersoon $contactpersoon */
        $contactpersoon = $this->findOneBy([
            'searchname' => $searchname,
        ]);
        
        return $contactpersoon;
    }
    
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contactpersoon::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Contactpersoon $contactpersoon): void
    {
        $this->getEntityManager()->persist($contactpersoon);
    }
}
