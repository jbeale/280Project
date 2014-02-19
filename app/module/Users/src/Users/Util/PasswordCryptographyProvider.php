<?php

namespace Users\Util;

use Zend\Crypt\Password\Bcrypt;

class PasswordCryptographyProvider
{
    //TODO move these settings somewhere else
    public static $PASSWORD_SALT = "KevinDurantIsABasketballPlayer!11%3234#";
    public static $TIME_COMPLEXITY = 15;

    public static function EncryptPassword ( $password)
    {
        $bcrypt = new Bcrypt(array(
            'salt' => PasswordCryptographyProvider::$PASSWORD_SALT,
            'cost' => PasswordCryptographyProvider::$TIME_COMPLEXITY
        ));
        $securePass = $bcrypt->create($password);

        return $securePass;
    }

    public static function VerifyPassword( $given,  $encryptedPass)
    {
        $bcrypt = new Bcrypt();
        return $bcrypt->verify($given, $encryptedPass);
    }
}