<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

define("LOADED", true);

use App\Facades\Application;


$app = new Application();

include_once dirname(__DIR__) . "/app/api.php";

$app->run();
