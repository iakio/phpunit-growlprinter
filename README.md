phpunit-growlprinter
========================

![growl](https://github.com/iakio/phpunit-growlprinter/wiki/images/phpunit-growlprinter.png)


## Usage

Specify a printerClass in phpunit.xml

```
<phpunit printerClass="iakio\phpunit\GrowlPrinter"
         printerFile="src\iakio\phpunit\GrowlPrinter.php">
...
</phpunit>
```

or, commandline.

```
$ phpunit --printer=iakio\\phpunit\\GrowlPrinter
```
