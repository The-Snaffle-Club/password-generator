# Destination Password Generator

This package contains two different types of generator:

### PasswordGenerator

Generates word based passwords [XKCD style](https://xkcd.com/936/) e.g. CorrectHorse7BatteryStaple!
These kinds of passwords are easier for users to remember.

### SecretGenerator

Generates long sequences of random letters/numbers/symbols. Best used for things like password reset tokens and other
access secrets.

## Requirements

* PHP >= 7.4

## Installation

Add the package to your project's dependencies with:

```shell
composer require destination/password-generator
```

## PasswordGenerator Usage

```php
<?php

$passwordGenerator = new \Destination\PasswordGenerator\PasswordGenerator();

// Returns a password like CorrectHorse^BatteryStaple6
$passwordGenerator->generate();
```

### Advanced Usage

By default, passwords will be generated using the following format:

`<Word><Word><Symbol><Word><Word><Digit>`

This can be changed by passing a structure argument to the generate function:

```php
<?php

$passwordGenerator = new \Destination\PasswordGenerator\PasswordGenerator();

// Returns a password like CorrectHorse7Staple
$passwordGenerator->generate('WWDW');
```

Password structures can be made up of a combination of the following:

| Code | Type   | Description                                         |
|------|--------|-----------------------------------------------------|
| W    | Word   | A random word from the given wordlist               |
| D    | Digit  | A single digit between 0 and 9                      |
| S    | Symbol | One of the following symbols: `~!@#$%^&*(){}[],./?` |

## SecretGenerator Usage

```php
<?php

$secretGenerator = new \Destination\PasswordGenerator\SecretGenerator();
// Returns a 64 character alpha-numeric string
$secretGenerator->generate();
```

### Advanced Usage

```php
<?php

$secretGenerator = new \Destination\PasswordGenerator\SecretGenerator();
// Returns a 32 character string with letters, numbers and symbols
$secretGenerator->generate(32, false);
```

Note that when passing a length to the generate method it must be an even number.
