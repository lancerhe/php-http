<?php
namespace LancerHe\Http\Request;

/**
 * Class Decorator 抽象HTTP装饰类
 *
 * @package LancerHe\Http\Request
 * @author  Lancer He <lancer.he@gmail.com>
 */
abstract class Decorator extends RequestAbstract {
    /**
     * 继承RequestAbstract的Request实例对象
     */
    protected $_httpRequest;
    /**
     * @var string
     */
    public $url;
    /**
     * @var array
     */
    public $post;

    /**
     * Decorator constructor.   初始化装饰器，装饰对象必须继承 RequestAbstract
     *
     * @param RequestAbstract $httpRequest
     */
    public function __construct(RequestAbstract $httpRequest) {
        $this->_httpRequest = $httpRequest;
    }

    /**
     * 装饰类方法不存在时，使用被装饰类方法
     *
     * @param      $func
     * @param null $params
     * @return mixed
     */
    public function __call($func, $params = null) {
        return call_user_func_array([$this->_httpRequest, $func], $params);
    }

    /**
     * 获取CURL Handler
     *
     * @return resource
     */
    public function getHandler() {
        return $this->_httpRequest->getHandler();
    }

    /**
     * 获取response信息
     *
     * @return mixed
     */
    public function getResponse() {
        return $this->_httpRequest->getResponse();
    }

    /**
     * 获取request信息
     *
     * @return mixed
     */
    public function getRequest() {
        return $this->_httpRequest->getRequest();
    }

    /**
     * 发送HTTP请求
     *
     * @param  array  $post POST数据，null表示无post即GET请求
     * @param  string $url  请求的URL地址，可以通过包装类指定一个URL
     * @return void
     */
    public function sendRequest($url = null, $post = null) {
        $this->url  = $url;
        $this->post = $post;
        return $this->_httpRequest->sendRequest($url, $post);
    }

    /**
     * 解析HTTP请求返回的response数据
     *
     * @return string
     */
    public function parseResponse() {
        return $this->_httpRequest->parseResponse();
    }
}