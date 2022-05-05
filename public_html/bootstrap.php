<?php

require 'vendor/autoload.php';
require 'System/DatabaseConnector.php';

use Dotenv\Dotenv;
use \System\DatabaseConnector;

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$db = new DatabaseConnector();
$dbConnection = $db->getConnection();

?>