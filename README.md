# composer-ecjia-auto-login

## Encrypt
默认使用系统自带的加密key进行加密，默认使用`app.auth_key`
```
$authcode = (new AuthLoginEncrypt([
                'admin_token' => 'xxxxxxxxxxxxxx',
                'store_id' => '11',
            ]))->encrypt();
```

使用自定义的加密key进行加密，$cipher是加密算法，默认取`app.cipher`
```
$encrypter = new AuthEncrypter($auth_key, $cipher);
$authcode = (new AuthLoginEncrypt([
                'admin_token' => 'xxxxxxxxxxxxxx',
                'store_id' => '11',
            ], $encrypter))->encrypt();
```

## Decrypt
默认使用系统自带的加密key进行加密，默认使用`app.auth_key`
```
$params = (new AuthLoginDecrypt($authcode))->decrypt();
```

使用自定义的加密key进行加密，$cipher是加密算法，默认取`app.cipher`
```
$encrypter = new AuthEncrypter($auth_key, $cipher);
$params = (new AuthLoginDecrypt($authcode, $encrypter))->decrypt();
```

默认超时时间30秒，如需自定义，实例对象的添加`$timeout`参数
```
$encrypter = new AuthEncrypter($auth_key, $cipher);
$params = (new AuthLoginDecrypt($authcode, $encrypter, 60))->decrypt();
```