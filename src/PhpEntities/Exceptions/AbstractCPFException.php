<?php

namespace hdvianna\PhpEntities\Exceptions;

abstract class AbstractCPFException extends \Exception
{
    public function __construct(string $cpf)
    {
        parent::__construct("The $cpf is invalid: {$this->getDetails()}", 400);
    }

    protected abstract function getDetails() : string;
}