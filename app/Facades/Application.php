<?php

namespace App\Facades;

class Application extends Facade
{
    private Router $router;

    public function __construct()
    {
        $this->router = new Router();
    }

    public function run()
    {
        return $this->router->resolve();
    }
}
