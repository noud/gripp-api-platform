<?php

namespace App\Doctrine;

use App\Entity\Taskphase;
use App\Entity\Tasktype;
use App\Entity\Tag;
use App\Service\TaskphaseService;
use App\Service\TasktypeService;
use App\Service\TagService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class HashPasswordListener.
 */
class EntityListener implements EventSubscriber
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var TaskphaseService
     */
    private $taskphaseService;
    
    /**
     * @var TasktypeService
     */
    private $tasktypeService;
    
    /**
     * HashPasswordListener constructor.
     */
    public function __construct(
        TaskphaseService $taskphaseService,
        TasktypeService $tasktypeService,
        TagService $tagService
    ) {
        $this->taskphaseService = $taskphaseService;
        $this->tasktypeService = $tasktypeService;
        $this->tagService = $tagService;
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (! ($entity instanceof Taskphase || $entity instanceof Tag)) {
            return;
        }

        $this->setEntityInAPI($entity);
        
        // necessary to force the update to see the change
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(\get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return ['preUpdate'];
    }

    /**
     * @param Taskphase|Tag $entity
     */
    private function setEntityInAPI($entity)   // @TODO should use Interface?
    {
        if ($entity instanceof Taskphase) {
            $this->taskphaseService->updateTaskphase($entity);
        } elseif ($entity instanceof Tasktype) {
            $this->tasktypeService->updateTasktype($entity);
        } elseif ($entity instanceof Tag) {
            $this->tagService->updateTag($entity);
        }
    }
}
