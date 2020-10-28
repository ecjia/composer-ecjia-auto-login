<?php


namespace Ecjia\Component\AutoLogin;

use Illuminate\Encryption\Encrypter;

class AuthLoginDecrypt
{
    /**
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * @var string
     */
    protected $authcode;

    /**
     * AuthLoginDecrypt constructor.
     * @param $authcode
     * @param $authkey
     */
    public function __construct($authcode, $encrypter = null)
    {
        $this->authcode = $authcode;

        if (is_null($encrypter)) {
            $this->encrypter = app('encrypter');
        }
        else {
            $this->encrypter = $encrypter;
        }
    }


    public function decrypt()
    {
        $authcode_decrypt = $this->encrypter->decrypt($this->authcode);
        $params   = array();

        parse_str($authcode_decrypt, $params);

        $start_time = $params['time'];

        $gm_timestamp = mktime(gmdate("H, i, s, m, d, Y"));
        $time_gap = $gm_timestamp - $start_time;

        if (intval($time_gap) > 30) {
            throw new AutoLoginException('抱歉！请求超时。');
        }

        return $params;
    }

}