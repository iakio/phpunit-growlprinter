<?php
namespace iakio\phpunit;

use Madalynn\Growl\Growl;
use Madalynn\Growl\Notification\Type;

class GrowlPrinter extends \PHPUnit_TextUI_ResultPrinter
{
    protected $capture = false;
    protected $buffer = "";
    protected $color = "";

    public function write($buffer)
    {
        if ($this->capture) {
            $this->buffer .= $buffer;
        } else {
            parent::write($buffer);
        }
    }

    protected function writeWithColor($color, $buffer)
    {
        if ($this->capture) {
            $this->color = $color;
            $this->buffer .= $buffer;
        } else {
            parent::writeWithColor($color, $buffer);
        }
    }

    protected function createGrowl()
    {
        $growl = new Growl("phpunit");
    }

    public function printResult(\PHPUnit_Framework_TestResult $result)
    {
        parent::printResult($result);

        $this->capture = true;
        parent::printFooter($result);
        $this->capture = false;

        if (strstr($this->color, 'red')) {
            $type = "FAIL";
        } elseif (strstr($this->color, 'green')) {
            $type = "SUCCESS";
        } else {
            $type = "WARN";
        }
        $growl = $this->createGrowl();
        $notification = new Type($type);
        $growl->addNotificationType($notification);
        $message = $notification->create($type, $this->buffer);
        $growl->sendNotify($message);
    }
} 
