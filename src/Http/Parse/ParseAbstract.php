<?php
/**
 * http parse abstract class
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-28
 */

namespace Http\Parse;

abstract class ParseAbstract {

    abstract public function parse();

    abstract public function setParse($parse);

    abstract public function getRequest();
}