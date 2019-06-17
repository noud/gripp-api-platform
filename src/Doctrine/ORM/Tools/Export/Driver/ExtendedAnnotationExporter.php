<?php

namespace App\Doctrine\ORM\Tools\Export\Driver;

use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Tools\EntityGenerator;
use Doctrine\ORM\Tools\Export\Driver\AbstractExporter;

/**
 * ClassMetadata extended exporter for PHP classes with annotations.
 *
 * @link    www.doctrine-project.org
 * @since   2.0
 * @author  Noud de Brouwer <noud4@home.nl>
 */
class ExtendedAnnotationExporter extends AbstractExporter
{
    protected $classToExtend = null;
    
    protected $excludefields = [];
    
    public function setClassToExtend($classToExtend)
    {
        $this->classToExtend = $classToExtend;
    }
    
    public function setExcludefields($excludefields)
    {
        $this->excludefields = $excludefields;
    }
    
    /**
     * @var string
     */
    protected $_extension = '.php';
    
    /**
     * @var EntityGenerator|null
     */
    private $_entityGenerator;
    
    /**
     * {@inheritdoc}
     */
    public function exportClassMetadata(ClassMetadataInfo $metadata)
    {
        if ( ! $this->_entityGenerator) {
            throw new \RuntimeException('For the AnnotationExporter you must set an EntityGenerator instance with the setEntityGenerator() method.');
        }

        $this->_entityGenerator->setGenerateAnnotations(true);
        $this->_entityGenerator->setGenerateStubMethods(false);
        $this->_entityGenerator->setRegenerateEntityIfExists(false);
        $this->_entityGenerator->setUpdateEntityIfExists(false);
        $this->_entityGenerator->setClassToExtend($this->classToExtend);
        
        return $this->_entityGenerator->generateEntityClass($metadata);
    }
    
//     /**
//      * @param ClassMetadataInfo $metadata
//      *
//      * @return string
//      */
//     protected function _generateOutputPath(ClassMetadataInfo $metadata)
//     {
//         return $this->_outputDir . '/' . str_replace('\\', '/', $metadata->name) . $this->_extension;
//     }
    
    /**
     * @param EntityGenerator $entityGenerator
     *
     * @return void
     */
    public function setEntityGenerator(EntityGenerator $entityGenerator)
    {
        $this->_entityGenerator = $entityGenerator;
    }
}
