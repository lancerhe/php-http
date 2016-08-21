<?php
namespace LancerHe\Http\Test\Parse\Decorator;

use LancerHe\Http\Parse\Decorator\LoggerFile;

/**
 * Class LoggerFileTest
 *
 * @package LancerHe\Http\Test\Parse\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class LoggerFileTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function write() {
        $stubHttpParse = $this->getMock('\LancerHe\Http\Parse\Sample', ['parse'], ['request']);
        $stubHttpParse->expects($this->any())
            ->method('parse')
            ->will($this->returnValue('{"a":1}'));
        $httpParse = new LoggerFile($stubHttpParse);
        $httpParse->setOutputFile("/tmp/phpunit.log");
        $httpParse->parse();
        $this->assertTrue(file_exists('/tmp/phpunit.log'));
        $log = file_get_contents('/tmp/phpunit.log');
        $this->assertContains("'origin' => 'request'", $log);
        $this->assertContains("'decode' => '{\"a\":1}'", $log);
    }

    /**
     *
     */
    public function tearDown() {
        unlink("/tmp/phpunit.log");
    }
}