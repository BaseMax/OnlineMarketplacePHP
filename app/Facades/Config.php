<?php

namespace App\Facades;

class Config extends Facade
{
    public static function secret(): string
    {
        return $_ENV["SECRET_KEY"] ?? "online_market";
    }
}
