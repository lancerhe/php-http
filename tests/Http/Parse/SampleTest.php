<?php
/**
 * HTTP Parse Sapmle Testcase.
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-28
 */

namespace Http\Tests\Parse;

use Http\Parse\Sample;

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