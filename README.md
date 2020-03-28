# php-entities
A php package with miscellaneous entities and their rules.

## Installation

```composer require hdvianna/php-entities```

## Entities List

- CPF: Brazilian individual taxpayer registry identification. This entity enforces the creation of valid CPFs
  - Usage: ``````new CPF(<String composed by 11 numbers>);``````
  - Example #1: ``````new CPF("28228228244"); //A valid CPF``````
  - Example #2: ``````new CPF("28228228245"); //A invalid CPF. Will throw a  InvalidCPFCheckDigitException.``````
