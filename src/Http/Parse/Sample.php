<?php
/**
 * http parse class
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-28
 */

namespace Http\Parse;

use Http\Parse\ParseAbstract;

class Sample extends ParseAbstract {

    protected $_parse = null;

    public function __construct($request) {
        $this->_request = $request;
        $this->_parse   = $request;
    }

    public function parse() {
        return $this->_parse;
    }

    public function setParse($parse) {
        $this->_parse = $parse;
    }

    public function getRequest() {
        return $this->_request;
    }
}
