<?php
/**
 * HTTP请求装饰类 简单加密请求 测试类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-25
 */

namespace Http\Tests\Parse\Decorator;

use Http\Parse\Sample;
use Http\Parse\Decorator\SimpleCrypt;

class SimpleCryptTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function parse() {
        $http_parse = new Sample("user=Lancer&age=28&sign=0edd12427c5ccea50701bb95c8f2d8cf");
        $http_parse = new SimpleCrypt($http_parse);
        $parse = $http_parse->parse();
        
        $this->assertEquals('Lancer', $parse['user']);
        $this->assertEquals('28', $parse['age']);
    }

    /**
     * @test
     */
    public function parseFailure() {
        $this->setExpectedException('Exception');
        $http_parse = new Sample("user=Lancer&age=28&sign=0edd1242c5ccea50701bb95c8f2d8cf");
        $http_parse = new SimpleCrypt($http_parse);
        $parse = $http_parse->parse();
    }
}