<?php
namespace LancerHe\Http\Test\Request\Decorator;

use LancerHe\Http\Request\Decorator\SimpleCrypt;

/**
 * Class SimpleCryptTest
 *
 * @package LancerHe\Http\Test\Request\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class SimpleCryptTest extends \PHPUnit_Framework_TestCase {
    /**
     * @test
     */
    public function send_mock_request_url_and_post() {
        $stubHttpRequest = $this->getMock('\LancerHe\Http\Request\Curl', ['executeRequest']);
        $stubHttpRequest->expects($this->any())
            ->method('executeRequest')
            ->will($this->returnValue('{"a":1}'));
        $httpRequest = new SimpleCrypt($stubHttpRequest);
        $httpRequest->sendRequest("http://www.baidu.com", ["a" => 1]);
        $this->assertEquals('a=1&sign=fa4400f7d0c5a5a91723b5bdcc9859e9', $httpRequest->getRequest()->post);
        $this->assertEquals('http://www.baidu.com', $httpRequest->getRequest()->url);
    }

    /**
     * @test
     */
    public function parse_response_from_json_to_array() {
        $stubHttpRequest = $this->getMock('\LancerHe\Http\Request\Curl', ['executeRequest']);
        $stubHttpRequest->expects($this->any())
            ->method('executeRequest')
            ->will($this->returnValue('{"a":1}'));
        $httpRequest = new SimpleCrypt($stubHttpRequest);
        $httpRequest->sendRequest("http://www.baidu.com", ["a" => 1]);
        $response = $httpRequest->parseResponse();
        $this->assertEquals(1, $response["a"]);
    }
}