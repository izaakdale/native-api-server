<?php

namespace Controllers;

require_once 'Controller.php';
require_once "../Models/Product.php";

use Controller;
use Product;

class ProductController extends Controller {

    public function processRequest($requestMethod, $requestParam=null)
    {
        switch ($requestMethod) {
            case 'GET':
                if(!$requestParam)
                {
                    $this->getProducts();
                }
                else
                {
                    $id = $requestParam;
                    $this->getProduct($id);
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
                    $this->deleteProduct($id);
                }
                break;
            default:
                $this->notFoundResponse();
                break;
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