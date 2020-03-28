<?php

namespace hdvianna\PhpEntities;


use hdvianna\PhpEntities\Exceptions\InvalidCPFCheckDigitException;
use hdvianna\PhpEntities\Exceptions\InvalidCPFContentException;
use hdvianna\PhpEntities\Exceptions\InvalidCPFLenghtException;
use PHPUnit\Framework\TestCase;

class CPFTest extends TestCase
{

    public function testAsString()
    {
        $cpf = new CPF("00000000000");
        $this->assertEquals("00000000000", $cpf->asString());

        $cpf = new CPF("11144477735");
        $this->assertEquals("11144477735", $cpf->asString());

        $cpf = new CPF("17117117133");
        $this->assertEquals("17117117133", $cpf->asString());

        $cpf = new CPF("28228228244");
        $this->assertEquals("28228228244", $cpf->asString());

    }

    public function testInvalidDigit()
    {
        $this->expectException(InvalidCPFCheckDigitException::class);
        (new CPF("28228228233"));
    }

    public function testInvalidLength_Bigger()
    {
        $this->expectException(InvalidCPFLenghtException::class);
        (new CPF("282282282331"));
    }

    public function testInvalidLength_Lower()
    {
        $this->expectException(InvalidCPFLenghtException::class);
        (new CPF("2822822823"));
    }

    public function testInvalidContent_Lower()
    {
        $this->expectException(InvalidCPFContentException::class);
        (new CPF("2@22E228233"));
    }
}
