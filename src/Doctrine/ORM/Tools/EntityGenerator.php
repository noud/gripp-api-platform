<?php

namespace App\Doctrine\ORM\Tools;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Tools\EntityGenerator as DoctrineEntityGenerator;

/**
 * Class extends EntityGenerator
 *
 *
 * @link    www.doctrine-project.org
 * @since   2.0
 * @author  Noud de Brouwer <noud4@home.nl>
 */
class EntityGenerator extends DoctrineEntityGenerator
{
    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityFieldMappingProperties(ClassMetadataInfo $metadata)
    {
        $lines = [];

        foreach ($metadata->fieldMappings as $fieldMapping) {
            if (isset($fieldMapping['declaredField'], $metadata->embeddedClasses[$fieldMapping['declaredField']]) ||
                $this->hasProperty($fieldMapping['fieldName'], $metadata) ||
                $metadata->isInheritedField($fieldMapping['fieldName'])
            ) {
                continue;
            }

            $lines[] = $this->generateFieldMappingPropertyDocBlock($fieldMapping, $metadata);
            $lines[] = $this->spaces . $this->fieldVisibility . ' $' . $fieldMapping['fieldName']
                     . (isset($fieldMapping['options']['default']) ? ' = ' . var_export($fieldMapping['options']['default'], true) : null) . ";\n";
        }

        return implode("\n", $lines);
    }
    
    /**
     * @return string
     */
    protected function generateEntityUse()
    {
        if (! $this->generateAnnotations) {
            return '';
        }
        
        return "\n".'use ApiPlatform\Core\Annotation\ApiResource;'."\n".'use Doctrine\ORM\Mapping as ORM;'."\n";
    }
    
    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateApiAnnotation(ClassMetadataInfo $metadata)
    {
        if (! $this->generateAnnotations) {
            return '';
        }
        
        if ($metadata->isEmbeddedClass) {
            return '';
        }
        
        return '@' . 'ApiResource';
    }
    
    /**
     * @TODO This class is private in Doctrine\ORM\Tools\EntityGenerator
     * 
     * @param ClassMetadataInfo $metadata
     * @return string
     */
    private function generateEntityListenerAnnotation(ClassMetadataInfo $metadata): string
    {
        if (0 === \count($metadata->entityListeners)) {
            return '';
        }
        
        $processedClasses = [];
        foreach ($metadata->entityListeners as $event => $eventListeners) {
            foreach ($eventListeners as $eventListener) {
                $processedClasses[] = '"' . $eventListener['class'] . '"';
            }
        }
        
        return \sprintf(
            '%s%s({%s})',
            '@' . $this->annotationsPrefix,
            'EntityListeners',
            \implode(',', \array_unique($processedClasses))
            );
    }
    
    /**
     * @param ClassMetadataInfo $metadata
     *
     * @return string
     */
    protected function generateEntityDocBlock(ClassMetadataInfo $metadata)
    {
        $lines = [];
        $lines[] = '/**';
        $lines[] = ' * ' . $this->getClassName($metadata);
        
        if ($this->generateAnnotations) {
            $lines[] = ' *';
            
            $methods = [
                'generateApiAnnotation',
                'generateTableAnnotation',
                'generateInheritanceAnnotation',
                'generateDiscriminatorColumnAnnotation',
                'generateDiscriminatorMapAnnotation',
                'generateEntityAnnotation',
                'generateEntityListenerAnnotation',
            ];
            
            foreach ($methods as $method) {
                if ($code = $this->$method($metadata)) {
                    $lines[] = ' * ' . $code;
                }
            }
            
            if (isset($metadata->lifecycleCallbacks) && $metadata->lifecycleCallbacks) {
                $lines[] = ' * @' . $this->annotationsPrefix . 'HasLifecycleCallbacks';
            }
        }
        
        $lines[] = ' */';
        
        return implode("\n", $lines);
    }
}
