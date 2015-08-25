<?php
/**
 * HTTP日志装饰类 测试类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-25
 */

namespace Http\Test\Parse\Decorator;

use Http\Parse\Sample;
use Http\Parse\Decorator\LoggerFile;

class LoggerFileTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function write() {
        $stub_http_parse = $this->getMock('\Http\Parse\Sample', array('parse'), array('request'));
        $stub_http_parse->expects($this->any())
            ->method('parse')
            ->will($this->returnValue('{"a":1}'));

        $http_request = new LoggerFile($stub_http_parse);
        $http_request->setOutputFile("/tmp/phpunit.log");
        $http_request->parse();

        $this->assertTrue(file_exists('/tmp/phpunit.log'));
        $log = file_get_contents('/tmp/phpunit.log');
        $this->assertContains("'origin' => 'request'", $log);
        $this->assertContains("'decode' => '{\"a\":1}'", $log);
    }

    public function tearDown() {
        unlink("/tmp/phpunit.log");
    }
}