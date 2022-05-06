<?

require '../bootstrap.php';
require '../Controllers/UserController.php';

use Controllers\UserController;

header("Content-Type: application/json");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"];

// form of api request should be in {{URL}}/api/model/param, explode => [0]/[1]/[2]/[3]
if($uri[1] == 'api')
{
    switch ($uri[2]) {
        case 'users':
            $controller = new UserController($dbConnection);
            $controller->processRequest($requestMethod, isset($uri[3]) ? (int) $uri[3] : null);
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

?>