<?php
namespace LancerHe\Http\Tests\Parse\Decorator;

use LancerHe\Http\Parse\Sample;
use LancerHe\Http\Parse\Decorator\SimpleCrypt;

/**
 * Class SimpleCryptTest
 *
 * @package LancerHe\Http\Tests\Parse\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class SimpleCryptTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function parse() {
        $http_parse = new Sample("user=Lancer&age=28&sign=0edd12427c5ccea50701bb95c8f2d8cf");
        $http_parse = new SimpleCrypt($http_parse);
        $parse      = $http_parse->parse();
        $this->assertEquals('Lancer', $parse['user']);
        $this->assertEquals('28', $parse['age']);
    }

    /**
     * @test
     */
    public function parse_failure() {
        $this->setExpectedException('Exception');
        $http_parse = new Sample("user=Lancer&age=28&sign=0edd1242c5ccea50701bb95c8f2d8cf");
        $http_parse = new SimpleCrypt($http_parse);
        $http_parse->parse();
    }
}