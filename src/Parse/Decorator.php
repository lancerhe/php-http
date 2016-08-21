<?php
namespace LancerHe\Http\Parse;

/**
 * Class Decorator
 *
 * @package LancerHe\Http\Parse
 * @author  Lancer He <lancer.he@gmail.com>
 */
abstract class Decorator extends ParseAbstract {
    /**
     * @var ParseAbstract
     */
    protected $_httpParse;

    /**
     * Decorator constructor.
     *
     * @param ParseAbstract $parse
     */
    public function __construct(ParseAbstract $parse) {
        $this->_httpParse = $parse;
    }

    /**
     * 装饰类方法不存在时，使用被装饰类方法
     *
     * @param      $func
     * @param null $params
     * @return mixed
     */
    public function __call($func, $params = null) {
        return call_user_func_array([$this->_httpParse, $func], $params);
    }

    /**
     * @return mixed
     */
    public function parse() {
        return $this->_httpParse->parse();
    }

    /**
     * @return mixed
     */
    public function getRequest() {
        return $this->_httpParse->getRequest();
    }
}