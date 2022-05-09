<?php

namespace Controllers;

require_once 'Controller.php';
require_once "../TableGateway/Gateway.php";
require_once "../Models/Product.php";

use TableGateway\Gateway;
use Controller;
use Product;

class ProductController extends Controller {

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
                    $response = $this->getProducts();
                }
                else
                {
                    $id = $requestParam;
                    $response = $this->getProduct($id);
                }
                break;
            case 'DELETE':
                if(!$requestParam)
                {
                    $response = $this->notFoundResponse();
                }
                else
                {
                    $id = $requestParam;
                    $response = $this->deleteProduct($id);
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

    public function getProducts()
    {
        $products = $this->gateway->index(Product::$tableName);
        return $this->foundResponse($products);
    }

    public function getProduct($id)
    {
        $product = $this->gateway->show(Product::$tableName ,$id);
        if(!$product)
        {
            return $this->notFoundResponse();
        }
        else
        {
            return $this->foundResponse($product);
        }
    }

    public function deleteProduct($id)
    {
        $deletionStatus = $this->gateway->delete(Product::$tableName, $id);
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