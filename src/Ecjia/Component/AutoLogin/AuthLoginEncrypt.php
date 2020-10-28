<?php


namespace Ecjia\Component\AutoLogin;

use Illuminate\Encryption\Encrypter;

class AuthLoginEncrypt
{
    /**
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * @var array
     */
    protected $params;

    /**
     * AuthLoginEncrypt constructor.
     * @param array $params
     * @param $authkey
     */
    public function __construct($params, $encrypter = null)
    {
        $this->params = $params;

        if (is_null($encrypter)) {
            $this->encrypter = app('encrypter');
        }
        else {
            $this->encrypter = $encrypter;
        }
    }


    public function encrypt()
    {
        $gm_timestamp = mktime(gmdate("H, i, s, m, d, Y")); // UTC time
        $this->params['time'] = $gm_timestamp;

        $authcode_str = http_build_query($this->params);
        $authcode = $this->encrypter->encrypt($authcode_str);

        return $authcode;
    }


}