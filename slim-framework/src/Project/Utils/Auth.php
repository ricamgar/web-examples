<?php

namespace Clipit\Services\Auth;

use DateTime;
use Firebase\JWT\JWT;
use Slim\Collection;
use Slim\Http\Request;

class Auth
{

    private $appConfig;

    public function __construct(Collection $appConfig)
    {
        $this->appConfig = $appConfig;
    }

    public function generateToken($username)
    {
        $now = new DateTime();
        $future = new DateTime("now +1 year");

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => base64_encode(random_bytes(16)),
            'iss' => $this->appConfig['app']['url'],  // Issuer
            "id" => $username,
        ];

        $secret = $this->appConfig['jwt']['secret'];
        $token = JWT::encode($payload, $secret, "HS256");

        return $token;
    }

}