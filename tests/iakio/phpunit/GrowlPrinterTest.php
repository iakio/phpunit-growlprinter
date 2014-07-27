<?php
namespace iakio\phpunit;

class GrowlPrinterTest extends \PHPUnit_Framework_TestCase {

    function test_capture_result() {
        $result = new \PHPUnit_Framework_TestResult();
        $printer = $this->getMockBuilder("iakio\\phpunit\\GrowlPrinter")
            ->setMethods(array("sendNotify"))
            ->getMock();
        $printer->expects($this->once())
            ->method("sendNotify")
            ->with("No tests executed!", "YELLOW");
        $printer->printResult($result);
    }
}
