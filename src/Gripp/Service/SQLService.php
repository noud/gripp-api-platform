<?php

namespace App\Gripp\Service;

use Doctrine\ORM\EntityManagerInterface;

class SQLService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function truncate(string $className): void
    {
        $cmd = $this->entityManager->getClassMetadata($className);
        $connection = $this->entityManager->getConnection();
        $connection->beginTransaction();
        
        try {
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $connection->query('DELETE FROM '.$cmd->getTableName());
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
            $connection->commit();
        } catch (\Exception $e) {
            $connection->rollback();
        }
        
        $connection->exec('ALTER TABLE ' . $cmd->getTableName() . ' AUTO_INCREMENT = 1;');
        $this->entityManager->clear();
    }
}
