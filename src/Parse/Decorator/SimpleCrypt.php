<?php
namespace LancerHe\Http\Parse\Decorator;

use LancerHe\Http\Parse\Decorator;

/**
 * Class SimpleCrypt
 *
 * @package LancerHe\Http\Parse\Decorator
 * @author  Lancer He <lancer.he@gmail.com>
 */
class SimpleCrypt extends Decorator {
    /**
     * @var string
     */
    protected $_crypt_key = '2S23ED';

    /**
     * @return array
     * @throws \Exception
     */
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
