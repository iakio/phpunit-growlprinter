<?php
namespace iakio\phpunit;

class GrowlPrinterTest extends \PHPUnit_Framework_TestCase
{
    public function test_capture_result()
    {
        $result = new \PHPUnit_Framework_TestResult();
        $printer = $this->getMockBuilder("iakio\\phpunit\\GrowlPrinter")
            ->setMethods(array("sendNotify"))
            ->getMock();
        // phpunit 3.7 returns 'No tests executed!\n'.
        $printer->expects($this->once())
            ->method("sendNotify")
            ->with($this->stringStartsWith("No tests executed!"), "YELLOW");
        $printer->printResult($result);
    }
}
