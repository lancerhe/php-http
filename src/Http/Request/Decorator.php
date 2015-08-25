<?php
/**
 * 抽象HTTP装饰类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-03-23
 */

namespace Http\Request;

use Http\Request\RequestAbstract;

abstract class Decorator extends RequestAbstract {

    /**
     * 继承Http_Request_Abstract的Request实例对象
     */
    protected $_http_request;

    /**
     * 初始化装饰器，装饰对象必须继承Http_Request_Abstract
     */
    public function __construct (RequestAbstract $http_request) {
        $this->_http_request = $http_request;
    }


    /**
     * 装饰类方法不存在时，使用被装饰类方法
     */
    public function __call($func, $params = null) {
        return call_user_func_array( array($this->_http_request, $func), $params);
    }


    /**
     * 获取CURL Handler
     * @return resource
     */
    public function getHandler() {
        return $this->_http_request->getHandler();
    }


    /**
     * 获取response信息
     * @return mixed
     */
    public function getResponse() {
        return $this->_http_request->getResponse();
    }


    /**
     * 获取request信息
     * @return mixed
     */
    public function getRequest() {
        return $this->_http_request->getRequest();
    }


    /**
     * 发送HTTP请求
     * @param  array   $post  POST数据，null表示无post即GET请求
     * @param  string  $url   请求的URL地址，可以通过包装类指定一个URL
     * @return void
     */
    public function sendRequest($url = null, $post = null) {
        $this->url = $url;
        $this->post = $post;
        return $this->_http_request->sendRequest($url, $post);
    }


    /**
     * 解析HTTP请求返回的response数据
     * @return mixed
     */
    public function parseResponse() {
        return $this->_http_request->parseResponse();
    }
}