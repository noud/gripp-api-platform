<?= "<?php\n" ?>

declare(strict_types=1);

namespace <?= $namespace ?>;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

final class <?= $class_name ?> extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
<?= $searchFields ?>;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
<?= $listFields ?>->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
<?= $formFields ?>;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
<?= $fields ?>;
    }
}
