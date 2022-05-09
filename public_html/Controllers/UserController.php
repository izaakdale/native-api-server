<?php

namespace Controllers;

require_once 'Controller.php';
require_once "../TableGateway/Gateway.php";
require_once "../Models/User.php";

use TableGateway\Gateway;
use Controller;
use User;

class UserController extends Controller {

    private $gateway;

    public function __construct($db)
    {
        $this->gateway = new Gateway($db);
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
        $users = $this->gateway->index(User::$tableName);
        return $this->foundResponse($users);
    }

    public function getUser($id)
    {
        $user = $this->gateway->show(User::$tableName, $id);
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