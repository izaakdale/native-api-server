<? 
// namespace Controllers;

require_once "../TableGateway/Gateway.php";
use TableGateway\Gateway;

abstract class Controller {

    protected $gateway;

    public function __construct($db)
    {
        $this->gateway = new Gateway($db);
    }

    public static function unauthorizedResponse($body=null)
    {
        header('HTTP/1.1 401 UNAUTHORIZED');
        exit($body);
    }

    public static function notFoundResponse($body=null)
    {
        header('HTTP/1.1 404 NOT FOUND');
        exit($body);
    }

    public static function foundResponse($body=null)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($body);        
        
        header($response['status_code_header']);
        if($response['body'])
        {
            print_r($response['body']);
        }
    }

    // Index.php sends uri requests here. Process request is implemented in each child class, 
    // there it handles all rest methods and asks the respective gateway to carry out the query
    abstract public function processRequest($requestMethod, $requestParams=null);

}


?>