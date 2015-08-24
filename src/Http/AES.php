<?php
/**
 * @desc Crypt_AES加解密类
 * @author Alexander_Li
 * @notice 本类使用前需要安装extension=php_mcrypt.dll扩展
 */

namespace Crypt;

class AES {

    /**
     * @desc
     * @notic cipher的值为密钥长度可以为128、192、256
     */
    private $__cipher = MCRYPT_RIJNDAEL_128;

    /**
     * @desc  模式 CBC ECB
     * @notic $__mode
     */
    private $__mode   = MCRYPT_MODE_CBC;

    /**
     * @desc  AES加密
     * 
     * @param  string $input   明文
     * @param  string $key     16个字符串
     * @param  string $iv      16个字符串
     * @return binary
     */
    public function encrypt($input, $key, $iv) {
        return base64_encode(mcrypt_encrypt($this->__cipher, $key, $input, $this->__mode, $iv));
    }


    /**
     * @desc  AES解密
     * 
     * @param  string $input    密文
     * @param  string $key      16个字符串
     * @param  string $iv       16个字符串
     * @return string
     */
    public function decrypt($input, $key, $iv) {
        $input = mcrypt_decrypt($this->__cipher, $key, base64_decode($input), $this->__mode, $iv);
        return $this->__removeExcessStr($input);
    }


    /**
     * @desc 去掉加密后多余的字符串
     * @param  string $input 明文
     * @return string
     */
    private function __removeExcessStr($input) {
        return rtrim($input, "\0");
    }
}