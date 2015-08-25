<?php
/**
 * HTTP日志装饰类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-03-23
 */

namespace Http\Request\Decorator;

use Http\Request\Decorator;
use Http\Request\RequestAbstract;

class LoggerFile extends Decorator {

    protected $_output_file = '/tmp/httprequest.log';

    public function setOutputFile($file) {
        return $this->_output_file = $file;
    }

    public function sendRequest($url = null, $post = null) {
        curl_setopt( $this->getHandler(), CURLINFO_HEADER_OUT, true);
        parent::sendRequest($url, $post);
        $this->outputFile();
    }

    public function outputFile() {
        $request  = curl_getinfo( $this->getHandler() );
        $response = $this->getResponse();
        $datetime = date('Y-m-d H:i:s');

        $output = 
            "============= [$datetime] >>>>>>>>>>>>" . PHP_EOL
            . '[request_header]     => ' . (isset($request['request_header']) ? rtrim($request['request_header'], "\r\n") : '') . PHP_EOL
            . '[request_url]        => ' . $this->getRequest()->url . PHP_EOL
            . '[request_body]       => ' . $this->getRequest()->post . PHP_EOL
            . '[response_http_code] => ' . $request['http_code'] . PHP_EOL
            . '[response_body]      => ' . $response . PHP_EOL
            . PHP_EOL;
        file_put_contents($this->_output_file, $output, FILE_APPEND);
    }
}