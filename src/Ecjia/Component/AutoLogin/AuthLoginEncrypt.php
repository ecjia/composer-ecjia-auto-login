<?php


namespace Ecjia\Component\AutoLogin;

use Illuminate\Encryption\Encrypter;
use RC_Crypt;
use RC_Time;

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
            $this->encrypter = royalcms('encrypter');
        }
        else {
            $this->encrypter = $encrypter;
        }
    }


    public function encrypt()
    {
        $this->params['time'] = RC_Time::gmtime();

        $authcode_str = http_build_query($this->params);
        $authcode = $this->encrypter->encrypt($authcode_str);

        return $authcode;
    }


}