<?

require '../bootstrap.php';
require '../Controllers/UserController.php';
require '../Controllers/ProductController.php';

use Controllers\UserController;
use Controllers\ProductController;

header("Content-Type: application/json");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
$requestMethod = $_SERVER["REQUEST_METHOD"];

// form of api request should be in {{URL}}/api/model/param, explode => [0]/[1]/[2]/[3]
if($uri[1] == 'api')
{
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

?>