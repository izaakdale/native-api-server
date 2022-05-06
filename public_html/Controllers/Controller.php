<? 

class Controller {

    public static function notFoundResponse()
    {
        header('HTTP/1.1 404 NOT FOUND');
        exit;
    }

    public static function foundResponse($body)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($body);
        return $response;
    }

    // Index.php sends uri requests here. Process request is implemented in each child class, 
    // there it handles all rest methods and asks the respective gateway to carry out the query
    public function processRequest($requestMethod, $requestParams=null)
    {
    }

}


?>