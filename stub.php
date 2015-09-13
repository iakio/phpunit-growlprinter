<?php
if (class_exists('Phar')) {
Phar::mapPhar('phpunit-growlprinter.phar');
}
require "phar://phpunit-growlprinter.phar/src/iakio/phpunit/GrowlPrinter.php";
require "phar://phpunit-growlprinter.phar/vendor/iakio/gntp-notify/src/iakio/GntpNotify/GNTP.php";
require "phar://phpunit-growlprinter.phar/vendor/iakio/gntp-notify/src/iakio/GntpNotify/GNTPRequest.php";
require "phar://phpunit-growlprinter.phar/vendor/iakio/gntp-notify/src/iakio/GntpNotify/GNTPResponse.php";
require "phar://phpunit-growlprinter.phar/vendor/iakio/gntp-notify/src/iakio/GntpNotify/IO.php";
require "phar://phpunit-growlprinter.phar/vendor/iakio/gntp-notify/src/iakio/GntpNotify/NotificationRequest.php";
require "phar://phpunit-growlprinter.phar/vendor/iakio/gntp-notify/src/iakio/GntpNotify/RegisterRequest.php";
require "phar://phpunit-growlprinter.phar/vendor/iakio/gntp-notify/src/iakio/GntpNotify/Resource.php";
__HALT_COMPILER(); ?>
