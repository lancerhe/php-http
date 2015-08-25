<?php
/**
 * http parse class
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-28
 */

namespace Http\Parse;

use Http\Parse\ParseAbstract;

class Sample extends ParseAbstract {

    protected $_request = null;

    public function __construct($request) {
        $this->_request = $request;
    }

    public function parse() {
        return $this->_request;
    }

    public function getRequest() {
        return $this->_request;
    }
}
