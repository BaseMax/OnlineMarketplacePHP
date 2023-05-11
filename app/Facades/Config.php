<?php

namespace App\Facades;

class Config extends Facade
{
    public static function secret(): string
    {
        return $_ENV["SECRET_KEY"] ?? "online_market";
    }

    public static function database_config(): array
    {
        return [
            "name"        => $_ENV["DB_NAME"],
            "password"    => $_ENV["DB_PASSWORD"],
            "user"        => $_ENV["DB_USER"],
            "host"        => $_ENV["DB_HOST"],
        ];
    }

    public static function dsn(): string
    {
        $database_config = self::database_config();

        $dsn = "mysql:host={$database_config['host']};dbname={$database_config['name']}";
        return $dsn;
    }

    public static function password(): string
    {
        return $_ENV["DB_PASSWORD"];
    }

    public static function user(): string
    {
        return $_ENV["DB_USER"];
    }

    public static function api_key(): string
    {
        return $_ENV["X_API_KEY"];
    }
}
