<?php
/**
 * HTTP请求装饰类 简单加密请求 测试类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-25
 */

namespace Http\Test\Request\Decorator;

use Http\Request\Decorator\SimpleCrypt;

class SimpleCryptTest extends \PHPUnit_Framework_TestCase {

    /**
     * @test
     */
    public function send_mock_request_url_and_post() {
        $stub_http_curl = $this->getMock('\Http\Request\Curl', array('executeRequest'));
        $stub_http_curl->expects($this->any())
            ->method('executeRequest')
            ->will($this->returnValue('{"a":1}'));

        $http_request = new SimpleCrypt($stub_http_curl);
        $http_request->sendRequest("http://www.baidu.com", array("a" => 1));

        $this->assertEquals('a=1&sign=fa4400f7d0c5a5a91723b5bdcc9859e9', $http_request->getRequest()->post);
        $this->assertEquals('http://www.baidu.com',                      $http_request->getRequest()->url);
    }

    /**
     * @test
     */
    public function parse_response_from_json_to_array($url = null, $post = null) {
        $stub_http_curl = $this->getMock('\Http\Request\Curl', array('executeRequest'));
        $stub_http_curl->expects($this->any())
            ->method('executeRequest')
            ->will($this->returnValue('{"a":1}'));

        $http_request = new SimpleCrypt($stub_http_curl);
        $http_request->sendRequest("http://www.baidu.com", array("a" => 1));
        $response = $http_request->parseResponse();

        $this->assertEquals(1, $response["a"]);
    }
}