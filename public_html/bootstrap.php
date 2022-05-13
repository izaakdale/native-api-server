<?php

require 'vendor/autoload.php';
require 'System/DatabaseConnector.php';
require 'System/CacheClient.php';

use Dotenv\Dotenv;
use \System\CacheClient;
use \System\DatabaseConnector;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$db = new DatabaseConnector();
$dbConnection = $db->getConnection();
$client = new CacheClient();
$cacheClient = $client->getClient();

?>