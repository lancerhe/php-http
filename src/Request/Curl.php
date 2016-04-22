<?php
/**
 * HTTP CURL 请求类 继承 Http_Request_Abstract 装饰者模式
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-03-23
 */

namespace Http\Request;

use Http\Request\RequestAbstract;

class Curl extends RequestAbstract {

    /**
     * CURL handler
     * @var resouser
     */
    protected $_handler;

    /**
     * Http请求后服务端返回的response
     * @var mixed
     */
    protected $_response = null;

    /**
     * Http请求后服务端request
     * @var mixed
     */
    protected $_request = null;

    /**
     * 初始化CURL请求Handler
     */
    public function __construct() {
        $this->_handler = curl_init();
        $this->_request = new \stdClass();
    }


    /**
     * 获取CURL Handler
     * @return resource
     */
    public function getHandler() {
        return $this->_handler;
    }


    /**
     * 获取response信息
     * @return mixed
     */
    public function getResponse() {
        return $this->_response;
    }


    /**
     * 获取request信息
     * @return mixed
     */
    public function getRequest() {
        return $this->_request;
    }


    /**
     * 发送HTTP请求
     * @param  string  $url   请求的URL地址，可以通过包装类指定一个URL
     * @param  array   $post  POST数据，null表示无post即GET请求
     * @return void
     */
    public function sendRequest($url = null, $post = null) {
        if ( $url ) {
            curl_setopt( $this->_handler, CURLOPT_URL, $url );
        }

        if ( $post ) {
            $post = is_array($post) ? http_build_query($post) : $post;
            curl_setopt( $this->_handler, CURLOPT_POST, 1 );
            curl_setopt( $this->_handler, CURLOPT_POSTFIELDS, $post );
        }

        curl_setopt( $this->_handler, CURLOPT_RETURNTRANSFER, true);

        $this->_request->post = $post;
        $this->_request->url  = $url;
        $this->_response = $this->executeRequest();
    }

    /**
     * 执行 Curl 请求
     */
    public function executeRequest() {
        return curl_exec( $this->_handler );
    }


    /**
     * 解析HTTP请求返回的response数据
     * @return mixed
     */
    public function parseResponse() {
        return $this->_response;
    }

    /**
     * 析构
     */
    public function __destruct() {  
        curl_close( $this->_handler );
    }
}