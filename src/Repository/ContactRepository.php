<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;

class ContactRepository extends ServiceEntityRepository
{
    
    public function findBySearchname(string $searchname): ?Contact
    {
        /** @var Contact $contact */
        $contact = $this->findOneBy([
            'searchname' => $searchname,
        ]);
        
        return $contact;
    }
    
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contact::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Contact $contact): void
    {
        $this->getEntityManager()->persist($contact);
    }
}
