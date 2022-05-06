<?php

namespace Controllers;
require 'Controller.php';
require "../TableGateway/UserGateway.php";
use TableGateway\UserGateway;
use Controller;

class UserController extends Controller {

    private $userGate;

    public function __construct($db)
    {
        $this->userGate = new UserGateway($db);
    }

    public function processRequest($requestMethod, $requestParam=null)
    {
        switch ($requestMethod) {
            case 'GET':
                if(!$requestParam)
                {
                    $response = $this->getUsers();
                }
                else
                {
                    $id = $requestParam;
                    $response = $this->getUser($id);
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if($response['body'])
        {
            print_r($response['body']);
        }
    }

    public function getUsers()
    {
        $users = $this->userGate->index();
        return $this->foundResponse($users);
    }

    public function getUser($id)
    {
        $user = $this->userGate->show($id);
        if(!$user)
        {
            return $this->notFoundResponse();
        }
        else
        {
            return $this->foundResponse($user);
        }
    }
}