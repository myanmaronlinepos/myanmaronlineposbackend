<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use App\Model\User;

class MatchesPassword extends AbstractRule{

    protected $password;
    
    /**
     * Class constructor.
     */
    public function __construct($password)
    {
        $this->password=$password;
    }

    public function validate($input){

        return password_verify($input,$this->password);
    }
}