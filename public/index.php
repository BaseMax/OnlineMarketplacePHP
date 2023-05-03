<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

define("LOADED", true);

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\Facades\Application;


$app = new Application();

include_once dirname(__DIR__) . "/app/api.php";

echo $app->run();
