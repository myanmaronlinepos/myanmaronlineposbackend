<?php
namespace App\Controllers;

class Controller{

    protected $container;

    /**
     * Class constructor.
     */
    public function __construct($container)
    {
        $this-> container=$container;
    }

    public function __get($property)
    {
        if($this->container->{$property}) {
            return $this->container->{$property};
        }
    }

}