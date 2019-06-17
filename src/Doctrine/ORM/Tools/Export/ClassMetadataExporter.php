<?php

namespace App\Doctrine\ORM\Tools\Export;

use Doctrine\ORM\Tools\Export\ClassMetadataExporter as DoctrineClassMetadataExporter;
use Doctrine\ORM\Tools\Export\Driver\AbstractExporter;
use Doctrine\ORM\Tools\Export\Driver\XmlExporter;
use Doctrine\ORM\Tools\Export\Driver\YamlExporter;
use Doctrine\ORM\Tools\Export\Driver\PhpExporter;
use Doctrine\ORM\Tools\Export\Driver\AnnotationExporter;
use Doctrine\ORM\Tools\Export\ExportException;

/**
 * Class extends ClassMetadataExporter
 *
 * @link    www.doctrine-project.org
 * @since   2.0
 * @author  Noud de Brouwer <noud4@home.nl>
 */
class ClassMetadataExporter extends DoctrineClassMetadataExporter

{
    /**
     * @var array
     */
    private static $_exporterDrivers = [
        'xml' => XmlExporter::class,
        'yaml' => YamlExporter::class,
        'yml' => YamlExporter::class,
        'php' => PhpExporter::class,
        'annotation' => AnnotationExporter::class,
        'annotation-extended' => Driver\ExtendedAnnotationExporter::class
    ];
    
    /**
     * Gets an exporter driver instance.
     *
     * @param string      $type The type to get (yml, xml, etc.).
     * @param string|null $dest The directory where the exporter will export to.
     *
     * @return Driver\AbstractExporter
     *
     * @throws ExportException
     */
    public function getExporter($type, $dest = null)
    {
        if ( ! isset(self::$_exporterDrivers[$type])) {
            throw ExportException::invalidExporterDriverType($type);
        }
        
        $class = self::$_exporterDrivers[$type];
        
        return new $class($dest);
    }
}
