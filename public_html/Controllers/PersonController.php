<?php

namespace Controllers;

require "../TableGateway/PersonGateway.php";
use TableGateway\PersonGateway;


class PersonController {
    private $db;
    private $requestMethod;
    private $userId;
    private $personGate;

    public function __construct($dbConnection, $requestMethod, $userId)
    {   
        $this->db = $dbConnection;
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;

        $this->personGate = new PersonGateway($this->db);
    }

    public function processRequest()
    {
        switch($this->requestMethod)
        {
            case 'GET' : 
                if($this->userId)
                {
                    $response = $this->getUser($this->userId);
                }
                else
                {
                    $response = $this->getUsers();
                }
                break;
        }

        header($response['status_code_header']);
        if($response['body'])
        {
            echo $response['body'];
        }
    }

    public function getUsers()
    {
        $users = $this->personGate->index();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($users);
        return $response;
    }

    public function getUser($id)
    {
        $user = $this->personGate->show($id);

        if(!$user)
        {
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($user);
        return $response;
    }

    public function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 NOT FOUND';
        $response['body'] = null;

        return $response;
    }



}