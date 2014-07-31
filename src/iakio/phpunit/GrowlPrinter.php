<?php
namespace iakio\phpunit;
use iakio\GntpNotify\GNTP;
use iakio\GntpNotify\IO;
use iakio\GntpNotify\NotificationRequest;
use iakio\GntpNotify\RegisterRequest;

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
        return new GNTP(new IO("localhost", 23053, false));
    }

    protected function sendNotify($buffer, $type)
    {
        $growl = $this->createGrowl();
        $register = new RegisterRequest("phpunit");
        $register->addNotification("GREEN",  array('icon_file' => __DIR__ . '/../../../resources/green.png'));
        $register->addNotification("RED",    array('icon_file' => __DIR__ . '/../../../resources/red.png'));
        $register->addNotification("YELLOW", array('icon_file' => __DIR__ . '/../../../resources/yellow.png'));
        $notify = new NotificationRequest("phpunit", $type, "phpunit", array("text" => $buffer));
        $growl->notifyOrRegister($notify, $register);
    }

    public function printResult(\PHPUnit_Framework_TestResult $result)
    {
        // Standard output
        parent::printResult($result);

        // Capture footer and send to Growl.
        $this->capture = true;
        parent::printFooter($result);
        $this->capture = false;

        if (strstr($this->color, 'red')) {
            $type = "RED";
        } elseif (strstr($this->color, 'green')) {
            $type = "GREEN";
        } else {
            $type = "YELLOW";
        }
        $this->sendNotify($this->buffer, $type);
    }
}
