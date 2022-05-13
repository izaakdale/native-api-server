<?php

namespace System;

use Predis\Client as client;

class CacheClient {

    private $client = null;

    public function __construct()
    {
        $host = getenv("CACHE_HOST");
        $port = getenv('CACHE_PORT');

        $this->client = new client([
            'scheme' => 'tcp',
            'host'   => $host,
            'port'   => $port
        ]);
    }

    public function getClient(){
        return $this->client;
    }

}