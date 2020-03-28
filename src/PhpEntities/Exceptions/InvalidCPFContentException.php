<?php

namespace hdvianna\PhpEntities\Exceptions;

class InvalidCPFContentException extends AbstractCPFException
{
    protected function getDetails(): string
    {
        return "The CPF must have only by numbers.";
    }
}