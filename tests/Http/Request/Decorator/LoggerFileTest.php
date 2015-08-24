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
        $http_request = new Curl();
        $http_request = new LoggerFile($http_request);
        $http_request->setLogFilePath("/tmp/phpunit.log");
        $http_request->sendRequest("http://127.0.0.1", array("a" => 1));

        $request = new \StdClass();
        $request->post = array(2);
        $request->url  = 'http://www.baidu.com';
        $http_request->setRequest($request);

        $this->assertTrue(file_exists('/tmp/phpunit.log'));
        $log = file_get_contents('/tmp/phpunit.log');
        //$this->assertContains('Host: 127.0.0.1', $log);
        $this->assertContains('[request_variable_body] => a=1', $log);
        $this->assertContains('[request_original_body] => a=1', $log);
        $this->assertContains('[response_http_code]', $log);
        $this->assertContains('[response_body]', $log);
    }

    public function tearDown() {
        parent::tearDown();
        exec("rm -rf /tmp/phpunit.log");
    }
}