<?php

namespace App\Admin\AbstractAdmin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin as SonataAbstractAdmin;

abstract class AbstractAdmin extends SonataAbstractAdmin
{
    protected $_sort_field = '';
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by' => '_sort_field',
    ];
    
    public function __construct($code, $class, $baseControllerName, $sort_field)
    {
            $this->code = $code;
            $this->class = $class;
            $this->baseControllerName = $baseControllerName;
            parent::__construct($code, $class, $baseControllerName);
            $this->datagridValues['_sort_by'] = $sort_field;
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('searchname')
        ;
    }
    
    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('_action', null, [
                'actions' => [
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }
    
    protected function configureShowFields(ShowMapper $showMapper): void
    {}
}
