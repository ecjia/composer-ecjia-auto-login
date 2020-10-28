<?php


namespace Ecjia\Component\AutoLogin;


use Illuminate\Encryption\Encrypter;

class AuthEncrypter
{
    /**
     * @var string
     */
    protected $authkey;

    /**
     * @var string
     */
    protected $cipher;

    /**
     * AuthEncrypter constructor.
     * @param string $authkey
     * @param string $cipher
     */
    public function __construct(?string $authkey = null, ?string $cipher = null)
    {
        $this->authkey = $authkey ?: config('system.auth_key');
        $this->cipher  = $cipher ?: config('system.cipher');
    }

    /**
     * @return string
     */
    public function getAuthkey(): string
    {
        return $this->authkey;
    }

    /**
     * @param string $authkey
     * @return AuthEncrypter
     */
    public function setAuthkey(string $authkey): AuthEncrypter
    {
        $this->authkey = $authkey;
        return $this;
    }

    /**
     * @return string
     */
    public function getCipher(): string
    {
        return $this->cipher;
    }

    /**
     * @param string $cipher
     * @return AuthEncrypter
     */
    public function setCipher(string $cipher): AuthEncrypter
    {
        $this->cipher = $cipher;
        return $this;
    }

    /**
     * @return Encrypter
     */
    public function getEncrypter()
    {
        return new Encrypter($this->authkey, $this->cipher);
    }

}