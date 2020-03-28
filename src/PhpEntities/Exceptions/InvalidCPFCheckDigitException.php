<?php

namespace hdvianna\PhpEntities\Exceptions;

class InvalidCPFCheckDigitException extends AbstractCPFException
{
    protected function getDetails(): string
    {
        return "The CPF check digit is invalid";
    }

}