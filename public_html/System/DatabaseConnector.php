<?php

namespace System;

use mysqli;

class DatabaseConnector {

    private $connection = null;

    public function __construct()
    {
        $host = getenv("DB_HOST");
        $port = getenv('DB_PORT');
        $db = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli($host, $user, $pass, $db, $port);
    }

    public function getConnection(){
        return $this->connection;
    }

}