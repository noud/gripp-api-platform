<?php

namespace App\Admin\AbstractAdmin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Admin\AbstractAdmin as SonataAbstractAdmin;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

abstract class AbstractAdmin extends SonataAbstractAdmin
{
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by' => '_sort_field',
    ];
    
    protected $entityManager;
    
    public function __construct(
        $code,
        $class,
        $baseControllerName,
        $sort_field
    ) {
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
            ])
        ;
    }
    
    protected function configureShowFields(ShowMapper $showMapper): void
    {}
    
    protected function getEnum(string $table, string $field)
    {
        $caseConverter = new CamelCaseToSnakeCaseNameConverter();
        $field = $caseConverter->normalize($field);
        $table = $caseConverter->normalize($table);

        $container = $this->getConfigurationPool()->getContainer();
        $entityManager = $container->get('doctrine.orm.entity_manager');
        $conn = $entityManager->getConnection();
        $sql = "SHOW COLUMNS FROM ".$table." WHERE Field = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $field);
        $stmt->execute();
        $type = $stmt->fetchAll();

        preg_match("/^enum\(\'(.*)\'\)$/", $type[0]['Type'], $matches);
        $enum = explode("','", $matches[1]);
        $enum = array_combine($enum, $enum);
        return $enum;
    }
}
