<?php
/**
 * HTTP Curl Testcase.
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-27
 */

namespace Http\Test\Request;

use Http\Request\Curl;

class CurlTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function setRequest() {
        $curl = new Curl();
        $request = new \StdClass();
        $request->post = array(2);
        $request->url  = 'http://www.baidu.com';
        $curl->setRequest($request);
        $result = $curl->getRequest();
        $this->assertEquals($result->post, $request->post);
        $this->assertEquals($result->url,  $request->url);
    }
}