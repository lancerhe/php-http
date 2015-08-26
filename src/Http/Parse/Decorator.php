<?php
/**
 * http parse decorator class
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-28
 */

namespace Http\Parse;

use Http\Parse\ParseAbstract;

abstract class Decorator extends ParseAbstract {

    public function __construct(ParseAbstract $parse) {
        $this->_http_parse = $parse;
    }

    /**
     * 装饰类方法不存在时，使用被装饰类方法
     */
    public function __call($func, $params = null) {
        return call_user_func_array( array($this->_http_parse, $func), $params);
    }

    public function parse() {
        return $this->_http_parse->parse();
    }

    public function getRequest() {
        return $this->_http_parse->getRequest();
    }
}