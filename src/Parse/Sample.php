<?php
namespace LancerHe\Http\Parse;

/**
 * Class Sample
 *
 * @package LancerHe\Http\Parse
 * @author  Lancer He <lancer.he@gmail.com>
 */
class Sample extends ParseAbstract {
    /**
     * @var mixed
     */
    protected $_request;

    /**
     * Sample constructor.
     *
     * @param $request
     */
    public function __construct($request) {
        $this->_request = $request;
    }

    /**
     * @return mixed
     */
    public function parse() {
        return $this->_request;
    }

    /**
     * @return mixed
     */
    public function getRequest() {
        return $this->_request;
    }
}
