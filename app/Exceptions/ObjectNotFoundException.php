<?php

namespace App\Exceptions;

use Exception;

class ObjectNotFoundException extends Exception
{
    public function __construct($object)
    {
        parent::__construct($object." demandé est introuvable.");
    }
}
