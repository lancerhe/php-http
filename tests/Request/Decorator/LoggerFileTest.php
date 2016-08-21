<?php
namespace LancerHe\Http\Test\Request\Decorator;

use LancerHe\Http\Request\Decorator\LoggerFile;

/**
 * Class LoggerFileTest
 *
 * @package LancerHe\Http\Test\Request\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class LoggerFileTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function write() {
        $stubHttpRequest = $this->getMock('\LancerHe\Http\Request\Curl', ['executeRequest']);
        $stubHttpRequest->expects($this->any())
            ->method('executeRequest')
            ->will($this->returnValue('{"a":1}'));
        $httpRequest = new LoggerFile($stubHttpRequest);
        $httpRequest->setOutputFile("/tmp/phpunit.log");
        $httpRequest->sendRequest("http://127.0.0.1", ["log" => "mywrite."]);
        // Assert
        $this->assertTrue(file_exists('/tmp/phpunit.log'));
        $log = file_get_contents('/tmp/phpunit.log');
        $this->assertContains('[request_header]', $log);
        $this->assertContains('[request_url]        => http://127.0.0.1', $log);
        $this->assertContains('[request_body]       => log=mywrite.', $log);
        $this->assertContains('[response_http_code]', $log);
        $this->assertContains('[response_body]      => {"a":1}', $log);
    }

    /**
     *
     */
    public function tearDown() {
        unlink("/tmp/phpunit.log");
    }
}