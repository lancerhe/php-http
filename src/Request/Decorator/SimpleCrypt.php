<?php
namespace LancerHe\Http\Request\Decorator;

use LancerHe\Http\Request\Decorator;

/**
 * Class SimpleCrypt 简单加密请求
 *
 * @package LancerHe\Http\Request\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class SimpleCrypt extends Decorator {
    /**
     * @param null $url
     * @param null $post
     */
    public function sendRequest($url = null, $post = null) {
        // 设置请求信息
        curl_setopt($this->getHandler(), CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($this->getHandler(), CURLOPT_TIMEOUT, 3);
        $crypt_key    = '2S23ED';
        $post['sign'] = md5(json_encode($post) . $crypt_key);
        parent::sendRequest($url, $post);
    }

    /**
     * @return array
     */
    public function parseResponse() {
        $response = parent::parseResponse();
        $response = json_decode($response, true);
        return $response;
    }
}