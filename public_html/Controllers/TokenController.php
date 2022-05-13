<?

namespace Controllers;

require_once 'Controller.php';
require_once "../TableGateway/Gateway.php";

use Controller;
use User;

// this class will receive a username and secret from index.php, 
// check the user database and if valid return a timed cached token stored in redis.
// this token will then be checked in future incoming api requests
class TokenController extends Controller 
{
    private $cacheClient;

    public function __construct($db, $cache)
    {
        parent::__construct($db);
        $this->cacheClient = $cache;      
    }

    public function processRequest($requestMethod, $requestParams = null)
    {
        if('GET' === $requestMethod)
        {
            $query = $this->gateway->get(User::$tableName, 'secret', 'name', $requestParams['clientId'] );

            if(password_verify($requestParams['clientSecret'], $query[0]['secret']))
            {
                $jwt = $this->generateJwt($requestParams['clientId']);

                // save a jwt to cache, return in 200 ok
                $this->cacheClient->set($jwt, 'true');
                $this->cacheClient->expire($jwt, getenv('CACHE_TOKEN_TIMEOUT'));

                return parent::foundResponse([
                    'token' => $jwt,
                ]);
            }
            else
            {
                $this->unauthorizedResponse('Invalid Credentials');
            }
        }
    }

    public function generateJwt($payloadArray)
    {
        $jwt = null;

        $header = json_encode([
            'typ' => 'JWT', 
            'alg' => 'HS256'
        ]);
        $payload = json_encode([
            $payloadArray,
            date("h:i:sa")
        ]);

        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, getenv('CACHE_TOKEN_KEY'), true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }

}