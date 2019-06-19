<?php

namespace App\Rpc\v3;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Timiki\Bundle\RpcServerBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Rpc\Method("tag.update")
 * @Rpc\Roles({
 *   "ROLE_API_USER"
 * })
 * @Rpc\Cache(lifetime=3600)
 */
class TagUpdate
{
    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     * @Assert\Positive
     */
    protected $param1;
    
    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $param2;
    
    /**
     * @var Serializer
     */
    private $serializer;
    
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
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $encoder = new JsonEncoder();
        $this->serializer = new Serializer([$normalizer], [$encoder]);
        
        $this->entityManager = $entityManager;
        $this->tagRepository = $tagRepository;
    }
    
    /**
     * @Rpc\Execute()
     */
    public function execute()
    {
        $tagId = (int) json_encode($this->param1);
        $serializedTag = json_encode($this->param2);
        $existingTag = $this->tagRepository->find($tagId);
        if ($existingTag) {
            $this->serializer->deserialize($serializedTag, Tag::class, 'json', ['object_to_populate' => $existingTag]);
            $this->entityManager->flush();
            return true;
        }
        return 'Does not exist.';
    }
}
