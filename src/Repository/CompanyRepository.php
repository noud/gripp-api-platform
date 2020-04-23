<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;

class CompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Company::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Company $company): void
    {
//         dump('BEFORE: ');
//         dump($company);
        $this->getEntityManager()->persist($company);
        
        $company->setId($company->getId());
        $this->getEntityManager()->persist($company);
//         dump('AFTER: ');
//         dump($company);
    }
    
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
