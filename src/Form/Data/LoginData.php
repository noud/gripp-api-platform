<?php

namespace App\Form\Data;

use Symfony\Component\Validator\Constraints as Assert;

class LoginData
{
    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    public $username;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    public $password;

    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    public $_csrf_token;
}
