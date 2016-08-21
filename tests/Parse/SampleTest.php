<?php
namespace LancerHe\Http\Tests\Parse;

use LancerHe\Http\Parse\Sample;

/**
 * Class SampleTest
 *
 * @package LancerHe\Http\Tests\Parse
 * @author  Lancer He <lancer.he@gmail.com>
 */
class SampleTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function parse() {
        $request    = "header=user&name=lancer";
        $http_parse = new Sample($request);
        $parse      = $http_parse->parse();
        $this->assertEquals("header=user&name=lancer", $parse);
    }
}