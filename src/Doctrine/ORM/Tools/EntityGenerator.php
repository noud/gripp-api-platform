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
}
