<?php

require_once "./vendor/autoload.php";

use App\Database\Migrations\Migrate;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$db_name = $_ENV["DB_NAME"] ?? "online_market";
$db_host = $_ENV["DB_HOST"] ?? "localhost";
$db_user = $_ENV["DB_USER"] ?? "root";
$db_password = $_ENV["DB_PASSWORD"] ?? "";

$migration = new Migrate($db_name, $db_host, $db_user, $db_password);

$migration->users();

$migration->categories();

$migration->products();

$migration->orders();

$migration->payments();


echo "=======================================" . PHP_EOL;
echo "=== Migrating Completed Successfuly ===" . PHP_EOL;
echo "=======================================" . PHP_EOL;
