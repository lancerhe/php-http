<?php
/**
 * HTTP日志装饰类
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-03-23
 */

namespace Http\Parse\Decorator;

use Http\Parse\Decorator;
use Http\Parse\RequestAbstract;

class LoggerFile extends Decorator {

    protected $_output_file = '/tmp/httpparse.log';

    public function setOutputFile($file) {
        return $this->_output_file = $file;
    }

    public function parse() {
        $parse = parent::parse();
        $this->outputFile($parse);
        return $parse;
    }

    public function outputFile($parse) {
        $output = array(
            'datetime' => date('Y-m-d H:i:s'),
            'origin'   => $this->getRequest(),
            'decode'   => $parse,
        );
        $output = var_export($output, true) . PHP_EOL;
        file_put_contents($this->_output_file, $output, FILE_APPEND);
    }
}