<?php

namespace App\Rpc\v3;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Timiki\Bundle\RpcServerBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Rpc\Method("tag.delete")
 * @ Rpc\Roles({
 *   "ROLE_NAME"
 * })
 * @Rpc\Cache(lifetime=3600)
 */
class TagDelete
{
    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    protected $param;
    
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    
    /**
     * @var TagRepository
     */
    private $tagRepository;
    
    public function __construct(
        EntityManagerInterface $entityManager,
        TagRepository $tagRepository
    ) {
        $this->entityManager = $entityManager;
        $this->tagRepository = $tagRepository;
    }
    
    /**
     * @Rpc\Execute()
     */
    public function execute()
    {
        $tag = $this->tagRepository->find($this->param);
        if ($tag) {
            $this->entityManager->remove($tag);
            $this->entityManager->flush();
            return true;
        }
        return 'Does not exist.';
    }
}
