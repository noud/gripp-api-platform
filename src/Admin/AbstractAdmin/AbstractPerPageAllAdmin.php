<?php

namespace App\Admin\AbstractAdmin;

abstract class AbstractPerPageAllAdmin extends AbstractAdmin
{
    protected $perPageOptions = [16, 32, 64, 128, 256, 'All' => 100000];
    
    protected $datagridValues = [
        '_per_page' => 'All',
    ];
    
    protected $maxPerPage = 100000;
    
    public function __construct($code, $class, $baseControllerName, $sort_field)
    {
            $this->code = $code;
            $this->class = $class;
            $this->baseControllerName = $baseControllerName;
            parent::__construct($code, $class, $baseControllerName, $sort_field);
    }
}
