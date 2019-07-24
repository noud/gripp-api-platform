<?php

namespace App\Repository;

use App\Entity\Taak;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TaakRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Taak::class);
    }
    
    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Taak $taak): void
    {
//         dump('BEFORE: ');
//         dump($taak);
        $taaktype = $taak->getType();
        $taakfase = $taak->getPhase();
        $bedrijf = $taak->getCompany();
        $taak->setType(null);
        $taak->setPhase(null);
        $taak->setCompany(null);
        $this->getEntityManager()->persist($taak);
        
        $taak->setId($taak->getId());
        if ($taaktype) {
            $taaktype = $this->getEntityManager()->merge($taaktype);
            $taak->setType($taaktype);
        }
        if ($taakfase) {
            $taakfase = $this->getEntityManager()->merge($taakfase);
            $taak->setPhase($taakfase);
        }
        if ($bedrijf) {
            $bedrijf = $this->getEntityManager()->merge($bedrijf);
            $taak->setCompany($bedrijf);
        }
        $this->getEntityManager()->persist($taak);
//         dump('AFTER: ');
//         dump($taak);
    }
    
    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
