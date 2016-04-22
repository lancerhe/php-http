<?php
/**
 * HTTP Parse Simple Crypt
 * @author Lancer He <lancer.he@gmail.com>
 * @since  2014-10-10
 */

namespace Http\Parse\Decorator;

use Http\Parse\Decorator;

class SimpleCrypt extends Decorator {

    protected $_crypt_key    = '2S23ED';

    public function parse() {
        $request = parent::parse();
        parse_str($request, $post);
        $sign = $post['sign'];
        unset($post['sign']);

        if ( $sign !== md5(json_encode($post) . $this->_crypt_key) ) {
            throw new \Exception();
        }
        return $post;
    }
}
