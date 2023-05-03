<?php

namespace App\Facades;

use Firebase\JWT\JWT as JsonWebToken;
use Firebase\JWT\Key;

class JWT extends Facade
{
    public static function encode(array $payload): string
    {
        $token = JsonWebToken::encode($payload, Config::secret(), "HS256");

        return $token;
    }

    public static function decode(string $token): array
    {
        $decoded_jwt = JsonWebToken::decode($token, new Key(Config::secret(), "HS256"));

        return json_decode(json_encode($decoded_jwt), true);
    }
}
