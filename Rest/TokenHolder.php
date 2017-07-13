<?php
namespace GrazeTech\SabreAPI\Rest;

use GrazeTech\SabreAPI\Rest\Auth;

class TokenHolder
{
    private static $token = null;
    private static $expirationDate = 0;

    public static function getToken()
    {
        if (TokenHolder::$token === null || ($t = time()) > TokenHolder::$expirationDate) {
            TokenHolder::$token = (new Auth)->callForToken();
            TokenHolder::$expirationDate = $t + TokenHolder::$token->expires_in;
        }
        return TokenHolder::$token;
    }
}
