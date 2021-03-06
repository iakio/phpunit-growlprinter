phpunit-growlprinter
========================
[![Build Status](https://travis-ci.org/iakio/phpunit-growlprinter.svg?branch=master)](https://travis-ci.org/iakio/phpunit-growlprinter)

![growl](https://github.com/iakio/phpunit-growlprinter/wiki/images/phpunit-growlprinter.png)

## Requirements

- PHP >= 5.3
- phpunit >= 4.8.\*,<5.5

## Usage

### PHAR

1. Download phpunit-growlprinter.phar from [here](https://github.com/iakio/phpunit-growlprinter/releases).

2. Create new bootstrap file.

  ```php
  <?php
  // bootstrap_growl.php
  require_once "phpunit-growlprinter.phar";
  // Put your own bootstrap file here
  // require_once "bootstrap.php";
  ```

3. Run

  ```sh
  $ phpunit --bootstrap=bootstrap_growl.php --printer=iakio\\phpunit\\GrowlPrinter
  ```


### Composer

1. Install
  ```sh
  $ php composer.phar require --dev iakio/phpunit-growlprinter:*
  ```

2. Specify printerClass in your phpunit.xml,

  ```xml
  <phpunit printerClass="iakio\phpunit\GrowlPrinter"
           printerFile="vendor/iakio/phpunit-growlprinter/src/iakio/phpunit/GrowlPrinter.php">
  ...
  </phpunit>
  ```

  or commandline.

  ```sh
  $ phpunit --printer=iakio\\phpunit\\GrowlPrinter
  ```

## Tips

If you want to use remote PHPUnit with local Growl, Use portforwarding:

```sh
$ ssh -R:23053:localhost:23053 myremotehost
```

or, override `GrowlPrinter` class.

```php
<?php
// src/MyGrowlPrinter.php
namespace app;
use iakio\GntpNotify\GNTP;
use iakio\GntpNotify\IO;
use iakio\phpunit\GrowlPrinter;

class MyGrowlPrinter extends GrowlPrinter
{
    protected function createGrowl()
    {
        return new GNTP(new IO("10.0.2.2", 23053));
    }
}
```

```xml
<phpunit printerClass="app\MyGrowlPrinter"
         printerFile="src/MyGrowlPrinter.php">
...
</phpunit>
```
