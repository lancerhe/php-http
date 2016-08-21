<?php
namespace LancerHe\Http\Request\Decorator;

use LancerHe\Http\Request\Decorator;

/**
 * Class LoggerFile 日志装饰类
 *
 * @package LancerHe\Http\Request\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class LoggerFile extends Decorator {
    /**
     * @var string
     */
    protected $_outputFile = '/tmp/httprequest.log';

    /**
     * @param $file
     */
    public function setOutputFile($file) {
        $this->_outputFile = $file;
    }

    /**
     * @param null $url
     * @param null $post
     */
    public function sendRequest($url = null, $post = null) {
        curl_setopt($this->getHandler(), CURLINFO_HEADER_OUT, true);
        parent::sendRequest($url, $post);
        $this->outputFile();
    }

    /**
     *
     */
    public function outputFile() {
        $request  = curl_getinfo($this->getHandler());
        $response = $this->getResponse();
        $datetime = date('Y-m-d H:i:s');
        $output   =
            "============= [$datetime] >>>>>>>>>>>>" . PHP_EOL
            . '[request_header]     => ' . (isset($request['request_header']) ? rtrim($request['request_header'], "\r\n") : '') . PHP_EOL
            . '[request_url]        => ' . $this->getRequest()->url . PHP_EOL
            . '[request_body]       => ' . $this->getRequest()->post . PHP_EOL
            . '[response_http_code] => ' . $request['http_code'] . PHP_EOL
            . '[response_body]      => ' . $response . PHP_EOL
            . PHP_EOL;
        file_put_contents($this->_outputFile, $output, FILE_APPEND);
    }
}