phpunit-growlprinter
========================

![growl](https://github.com/iakio/phpunit-growlprinter/wiki/images/phpunit-growlprinter.png)

## Requirements

- PHP >= 5.3
- phpunit >= 3.7.\*

## Installation

```
php composer.phar require --dev iakio/phpunit-growlprinter:*
```

## Usage

Specify a printerClass in your phpunit.xml,

```
<phpunit printerClass="iakio\phpunit\GrowlPrinter"
         printerFile="vendor/iakio/phpunit-growlprinter/src/iakio/phpunit/GrowlPrinter.php">
...
</phpunit>
```

or commandline.

```
$ phpunit --printer=iakio\\phpunit\\GrowlPrinter
```
