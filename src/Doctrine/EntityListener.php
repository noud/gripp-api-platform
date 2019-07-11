<?php

namespace App\Doctrine;

use App\Entity\Taakfase;
use App\Entity\Tag;
use App\Service\TaakfaseService;
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
     * HashPasswordListener constructor.
     */
    public function __construct(
        TaakfaseService $taakfaseService,
        TagService $tagService
    ) {
        $this->taakfaseService = $taakfaseService;
        $this->tagService = $tagService;
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (! ($entity instanceof Taakfase || $entity instanceof Tag)) {
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
     * @param Taakfase|Tag $entity
     */
    private function setEntityInAPI($entity)   // @TODO should use Interface?
    {
        if ($entity instanceof Taakfase) {
            $this->taakfaseService->updateTaakfase($entity);
        } elseif ($entity instanceof Tag) {
            $this->tagService->updateTag($entity);
            
        }
    }
}
