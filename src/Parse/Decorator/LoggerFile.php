<?php
namespace LancerHe\Http\Parse\Decorator;

use LancerHe\Http\Parse\Decorator;

/**
 * Class LoggerFile
 *
 * @package LancerHe\Http\Parse\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class LoggerFile extends Decorator {
    /**
     * @var string
     */
    protected $_outputFile = '/tmp/httpparse.log';

    /**
     * @param $file
     */
    public function setOutputFile($file) {
        $this->_outputFile = $file;
    }

    /**
     * @return mixed
     */
    public function parse() {
        $parse = parent::parse();
        $this->outputFile($parse);
        return $parse;
    }

    /**
     * @param $parse
     */
    public function outputFile($parse) {
        $output = [
            'datetime' => date('Y-m-d H:i:s'),
            'origin'   => $this->getRequest(),
            'decode'   => $parse,
        ];
        $output = var_export($output, true) . PHP_EOL;
        file_put_contents($this->_outputFile, $output, FILE_APPEND);
    }
}