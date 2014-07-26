<?php
namespace iakio\phpunit;

use iakio\GntpNotify\GNTP;

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
        return new GNTP("phpunit");
    }

    protected function sendNotify($buffer, $type, $icon)
    {
        $growl = $this->createGrowl();
        $growl->sendNotify($type, $type, $buffer,
            array('icon_file' => __DIR__ . '/../../../resources/' . $icon));
    }

    public function printResult(\PHPUnit_Framework_TestResult $result)
    {
        parent::printResult($result);

        $this->capture = true;
        parent::printFooter($result);
        $this->capture = false;

        if (strstr($this->color, 'red')) {
            $type = "FAIL";
            $icon = "red.png";
        } elseif (strstr($this->color, 'green')) {
            $type = "SUCCESS";
            $icon = "green.png";
        } else {
            $type = "WARN";
            $icon = "yellow.png";
        }
        $this->sendNotify($this->buffer, $type, $icon);
    }
} 
