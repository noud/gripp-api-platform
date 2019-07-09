<?php

namespace App\Gripp\Service;

use com_gripp_API;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class APIService
{
    /**
     * @var com_gripp_API
     */
    public $API;

    /**
     * @var Serializer
     */
    protected $serializer;

    public function __construct(
        string $token = '#APITOKEN#' //Your API token
    ) {
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ObjectNormalizer($classMetadataFactory);
        $this->serializer = new Serializer([$normalizer]);
        
        $this->API = new com_gripp_API($token);
    }
}
