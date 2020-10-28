<?php


namespace Ecjia\Component\AutoLogin;

use Illuminate\Encryption\Encrypter;
use RC_Crypt;
use RC_Time;

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
            $this->encrypter = royalcms('encrypter');
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

        $time     = RC_Time::gmtime();
        $time_gap = $time - $start_time;

        if (intval($time_gap) > 30) {
            throw new AutoLoginException(__('抱歉！请求超时。', 'ecjia'));
        }

        return $params;
    }

}