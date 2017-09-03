<?php

/**
 * Created by PhpStorm.
 * User: Iren
 * Date: 8/29/2017
 * Time: 5:43 PM
 */
class ValidationException extends RuntimeException
{

    private $errors = [];
    
    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct('Validation error.');
    }

    public function getErrors()
    {
        return $this->errors;
    }
    
}