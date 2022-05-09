<?php

namespace Controllers;
require_once 'Controller.php';
require "../TableGateway/ProductGateway.php";
use TableGateway\ProductGateway;
use Controller;

class ProductController extends Controller {

    private $productGate;

    public function __construct($db)
    {
        $this->productGate = new ProductGateway($db);
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
        $products = $this->productGate->index();
        return $this->foundResponse($products);
    }

    public function getProduct($id)
    {
        $product = $this->productGate->show($id);
        if(!$product)
        {
            return $this->notFoundResponse();
        }
        else
        {
            return $this->foundResponse($product);
        }
    }
}