<?php

namespace hdvianna\PhpEntities\Exceptions;

use hdvianna\PhpEntities\CPF;

class InvalidCPFLenghtException extends AbstractCPFException
{
    protected function getDetails(): string
    {
        return "The CPF must have ".CPF::CPF_LENGTH." digits.";
    }

}