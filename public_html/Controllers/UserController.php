<?php

namespace Controllers;

require_once 'Controller.php';
require_once "../Models/User.php";

use Controller;
use User;

class UserController extends Controller {

    public function processRequest($requestMethod, $requestParam=null)
    {
        switch ($requestMethod) {
            case 'GET':
                if(!$requestParam)
                {
                    $this->getUsers();
                }
                else
                {
                    $id = $requestParam;
                    $this->getUser($id);
                }
                break;
            case 'DELETE':
                if(!$requestParam)
                {
                    $this->notFoundResponse();
                }
                else
                {
                    $id = $requestParam;
                    $this->deleteUser($id);
                }
                break;
            default:
                $this->notFoundResponse();
                break;
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

    public function deleteUser($id)
    {
        $deletionStatus = $this->gateway->delete(User::$tableName, $id);
        if(TRUE === $deletionStatus)
        {
            return $this->foundResponse('Deleted Successfully');
        }
        else
        {
            return $this->notFoundResponse();
        }
    }
}