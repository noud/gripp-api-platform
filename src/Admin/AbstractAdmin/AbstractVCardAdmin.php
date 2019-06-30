<?php

namespace App\Admin\AbstractAdmin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

abstract class AbstractVCardAdmin extends AbstractAdmin
{
    public function __construct($code, $class, $baseControllerName, $sort_field)
    {
            $this->code = $code;
            $this->class = $class;
            $this->baseControllerName = $baseControllerName;
            parent::__construct($code, $class, $baseControllerName, $sort_field);
    }
    
    public function getExportFormats()
    {
        return ['vcf', 'json', 'xml', 'csv', 'xls'];
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('active')
        ;
        parent::configureDatagridFilters($datagridMapper);
    }
    
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('active', null, [
                'editable' => true,
            ])
        ;
        parent::configureListFields($listMapper);
    }
}
