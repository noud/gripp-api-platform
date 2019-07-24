<?php

namespace App\Repository;

use App\Entity\Bedrijf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class BedrijfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bedrijf::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Bedrijf $bedrijf): void
    {
//         dump('BEFORE: ');
//         dump($bedrijf);
        $this->getEntityManager()->persist($bedrijf);
        
        $bedrijf->setId($bedrijf->getId());
        $this->getEntityManager()->persist($bedrijf);
//         dump('AFTER: ');
//         dump($bedrijf);
    }
    
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
