<?php

namespace App\Repository;

use App\Entity\Taak as Task;
use App\Entity\Employee as User;
use App\Entity\Contact;
use App\Entity\Timelineentry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry as RegistryInterface;

class TimelineentryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Timelineentry::class);
    }
    
    public function findCompaniesByContact(Contact $contact): ?Array
    {
        $sub = $this->createQueryBuilder('te2');
        $sub
            ->from("App\Entity\Timelineentry","te3")
            ->where('te3.company = te.company')
            ->andWhere('te3.date > te.date')
        ;
        
        $queryBuilder = $this->createQueryBuilder('te');
        $queryBuilder
            ->select(['te.date','company.companyname'])
            ->leftJoin('te.company', 'company')
            ->where($queryBuilder->expr()->not($queryBuilder->expr()->exists($sub->getDQL())))
            ->andWhere('te.contact = :contact')
            ->setParameters([
                'contact' => $contact,
            ])
            ->orderBy('te.date','desc')
        ;
            
        return $queryBuilder->getQuery()->getArrayResult();
    }
    
    public function findMessagesByUser(User $user): ?array
    {
        $sub = $this->createQueryBuilder('te2');
        $sub->from("App\Entity\Timelineentry","te3");
        $sub->andWhere('te3.task = te.task');
        $sub->andWhere('te3.date > te.date');
        
        $queryBuilder = $this->createQueryBuilder('te');
        $queryBuilder
            ->leftJoin('te.task', 'taak')
            ->andWhere($queryBuilder->expr()->not($queryBuilder->expr()->exists($sub->getDQL())))
            ->innerJoin('taak.phase', 'taakfase')
            ->select(['te.date','taak.id','taak.description','taakfase.name','taakfase.color'])
            ->andWhere('te.employee = :employee')
            ->setParameters([
                'employee' => $user,
            ])
            ->orderBy('te.date','desc')
        ;
        
        return $queryBuilder->getQuery()->getArrayResult();
    }
    
    public function findMessagesByUserId(User $user): ?Array
    {
        $queryBuilder = $this->createQueryBuilder('te');
        $queryBuilder
            ->select(['te.date','te.id','te.message','bedrijf.firstname','bedrijf.infix','bedrijf.lastname'])
            ->leftJoin('te.company', 'bedrijf')
            ->andWhere('te.employee = :employee')
            ->andWhere('te.timelinetype LIKE :usermessage')
            ->setParameters([
                'employee' => $user,
                'usermessage' => 'USERMESSAGE',
            ])
            ->orderBy('te.date','desc')
        ;
        
        return $queryBuilder->getQuery()->getArrayResult();
    }
    
    public function findTasksByUserId(User $user): ?Array
    {
        $sub = $this->createQueryBuilder('te2');
        $sub->from("App\Entity\Timelineentry","te3");
        $sub->andWhere('te3.task = te.task');
        $sub->andWhere('te3.date > te.date');
        
        $queryBuilder = $this->createQueryBuilder('te');
        $queryBuilder
            ->leftJoin('te.task', 'taak')
            ->andWhere($queryBuilder->expr()->not($queryBuilder->expr()->exists($sub->getDQL())))
            ->innerJoin('taak.phase', 'taakfase')
            ->select(['te.date','taak.id','taak.description','taakfase.name','taakfase.color'])
            ->andWhere('te.employee = :employee')
            ->setParameters([
                'employee' => $user,
            ])
            ->orderBy('te.date','desc')
         ;

         return $queryBuilder->getQuery()->getArrayResult();
    }
}
