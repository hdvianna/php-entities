<?php


namespace hdvianna\PhpEntities;


use hdvianna\PhpEntities\Exceptions\InvalidCPFCheckDigitException;
use hdvianna\PhpEntities\Exceptions\InvalidCPFContentException;
use hdvianna\PhpEntities\Exceptions\InvalidCPFLenghtException;

class CPF implements StringValueInterface
{

    const CPF_LENGTH = 11;
    const CPF_NUMBER_LENGTH = 9;
    const CHECK_DIGIT_START_INDEX = 9;
    const CPF_DIGIT_LENGTH = 2;
    const CPF_MOD = 11;

    private string $cpf;

    /**
     * CPF constructor.
     */
    public function __construct(string $cpf)
    {
        $this->cpf = $cpf;
        $this->checkLength()
            ->checkOnlyNumbers()
            ->checkDigit();
    }

    private function checkLength(): CPF
    {
        if (strlen($this->cpf) !== self::CPF_LENGTH) {
            throw new InvalidCPFLenghtException($this->cpf);
        }
        return $this;
    }

    private function checkOnlyNumbers(): CPF
    {
        $matches = preg_match("/^[0-9]{" . self::CPF_LENGTH . "}$/", $this->cpf);
        if ($matches === 0) {
            throw new InvalidCPFContentException($this->cpf);
        }
        return $this;
    }

    private function checkDigit(): CPF
    {
        $cpfDigitPart = substr($this->cpf, 0, self::CPF_NUMBER_LENGTH);
        $firstCheckDigit = $this->calculateFirstCheckDigit($cpfDigitPart);
        $secondCheckDigit = $this->calculateSecondCheckDigit($cpfDigitPart, $firstCheckDigit);
        $informedCheckDigit = substr($this->cpf, self::CHECK_DIGIT_START_INDEX, self::CPF_DIGIT_LENGTH);
        $calculatedCheckDigit = "{$firstCheckDigit}{$secondCheckDigit}";
        if ($calculatedCheckDigit !== $informedCheckDigit) {
            throw new InvalidCPFCheckDigitException($this->cpf);
        }
        return $this;
    }

    private function calculateFirstCheckDigit(string $cpfDigitPart)
    {
        $firstDigitSum = $this->calculateSum($cpfDigitPart);
        return $this->calculateMod11($firstDigitSum);
    }

    private function calculateSecondCheckDigit(string $cpfDigitPart, string $firstCheckDigit)
    {
        $cpfPart = $cpfDigitPart . $firstCheckDigit;
        $secondDigitSum = $this->calculateSum($cpfPart);
        return $this->calculateMod11($secondDigitSum);
    }

    private function calculateSum(string $cpfPart)
    {
        $start = strlen($cpfPart) - 1;
        $factor = 2;
        $sum = 0;
        for ($i = $start; $i >= 0; $i--) {
            $sum += (intval($this->cpf[$i]) * $factor);
            $factor++;
        }
        return $sum;
    }

    private function calculateMod11($sum)
    {
        $remainder = $sum % self::CPF_MOD;
        if ($remainder < 2) {
            return 0;
        } else {
            return self::CPF_MOD - $remainder;
        }
    }

    public function asString(): string
    {
        return $this->cpf;
    }

}