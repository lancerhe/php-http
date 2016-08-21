<?php
namespace LancerHe\Http\Parse;

/**
 * Class ParseAbstract
 *
 * @package LancerHe\Http\Parse
 * @author  Lancer He <lancer.he@gmail.com>
 */
abstract class ParseAbstract {
    /**
     * @return mixed
     */
    abstract public function parse();

    /**
     * @return mixed
     */
    abstract public function getRequest();
}