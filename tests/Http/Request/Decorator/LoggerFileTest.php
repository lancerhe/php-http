<?php
/**
 * HTTP日志装饰类 测试类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-25
 */

namespace Http\Test\Request\Decorator;

use Http\Request\Curl;
use Http\Request\Decorator\LoggerFile;

class LoggerFileTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function write() {
        $stub_http_curl = $this->getMock('\Http\Request\Curl', array('executeRequest'));
        $stub_http_curl->expects($this->any())
            ->method('executeRequest')
            ->will($this->returnValue('{"a":1}'));

        $http_request = new LoggerFile($stub_http_curl);
        $http_request->setOutputFile("/tmp/phpunit.log");
        $http_request->sendRequest("http://127.0.0.1", array("log" => "mywrite."));

        $this->assertTrue(file_exists('/tmp/phpunit.log'));
        $log = file_get_contents('/tmp/phpunit.log');
        $this->assertContains('[request_header]',   $log);
        $this->assertContains('[request_url]        => http://127.0.0.1', $log);
        $this->assertContains('[request_body]       => log=mywrite.', $log);
        $this->assertContains('[response_http_code]', $log);
        $this->assertContains('[response_body]      => {"a":1}', $log);
    }

    public function tearDown() {
        unlink("/tmp/phpunit.log");
    }
}