<?= "<?php\n" ?>

declare(strict_types=1);

namespace <?= $namespace ?>;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

final class <?= $class_name ?> extends \App\Admin\AbstractAdmin\AbstractAdmin
{
    public function __construct(
        $code,
        $class,
        $baseControllerName
    ) {
        parent::__construct($code, $class, $baseControllerName, 'name');
    }
    
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        parent::configureDatagridFilters($datagridMapper);
<?php if (strlen(trim($searchFields)) > 0):?>
        $datagridMapper
<?= $searchFields ?>
		;
<?php endif ?>
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        parent::configureListFields($listMapper);
        $listMapper
<?= $listFields ?>
		;
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
<?= $formFields ?>
		;
    }
}
