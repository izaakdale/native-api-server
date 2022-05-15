<?

require_once '../bootstrap.php';
require_once '../Controllers/UserController.php';
require_once '../Controllers/ProductController.php';
require_once '../Controllers/TokenController.php';

use Controllers\UserController;
use Controllers\ProductController;
use Controllers\TokenController;

header("Content-Type: application/json");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"];

// cacheClient from bootstap
if(authenticate($cacheClient))
{
    if('api' == $uri[1])
    {
        // form of api request should be in {{URL}}/api/model/param, explode => [0]/[1]/[2]/[3]
        switch ($uri[2]) {
            case 'users':
                $userController = new UserController($dbConnection);
                $userController->processRequest($requestMethod, isset($uri[3]) ? (int) $uri[3] : null);
                break;
            case 'products':
                $productController = new ProductController($dbConnection);
                $productController->processRequest($requestMethod, isset($uri[3]) ? (int) $uri[3] : null);
                break;
            default:
                return Controller::notFoundResponse();
                break;
        }
    }
    else
    {
        return Controller::notFoundResponse();
    }
}
else
{
    // not authenticated
    // check if api request is for authentication
    // return either 401 unauthorized or a jwt
    if($uri[1] == 'api')
    {
        switch ($uri[2]) {
            case 'token':
                if(isset($_SERVER['HTTP_CLIENTID']) && isset($_SERVER['HTTP_CLIENTSECRET']))
                {
                    $params = [
                        'clientId' => $_SERVER['HTTP_CLIENTID'],
                        'clientSecret' => $_SERVER['HTTP_CLIENTSECRET']
                    ];
                    $tokenController = new TokenController($dbConnection, $cacheClient);
                    $tokenController->processRequest($requestMethod, $params);
                }
                else{
                    return Controller::notFoundResponse('Invalid headers');
                }
                break;
            // requests that end up here are unauthorized but in a valid form URL/api/model
            default:
                return Controller::unauthorizedResponse('Unauthorized');
                break;
        }
    }
}

function authenticate($cacheClient)
{
    if(isset($_SERVER['HTTP_AUTHORIZATION']))
    {
        $tokenValue = $cacheClient->get($_SERVER['HTTP_AUTHORIZATION']);
        if($tokenValue)
        {
            $tokenArray = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $_SERVER['HTTP_AUTHORIZATION'])[1]))));
    
            $tokenTime = date_create($tokenArray[1])->getTimestamp();
            $nowTime = date_create()->getTimestamp();
            
            $timeDiff = $nowTime - $tokenTime;
    
            if(getenv('CACHE_TOKEN_TIMEOUT') >= $timeDiff)
            {
                return true;
            }
            else
            {
                // token timestamp is older than the specified timeout.
                return Controller::unauthorizedResponse('Unauthorized');
            }
        }
        else
        {
            return Controller::unauthorizedResponse('Unauthorized');
        }

    }
}

?>