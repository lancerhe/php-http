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
        $http_parse = new Sample("header=user&name=lancer");
        $request = $http_parse->parse();
        $this->assertEquals("header=user&name=lancer", $request);
    }
}