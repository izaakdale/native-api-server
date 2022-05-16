<?

require_once "../Generators/GaussianGenerator.php";

class GaussianController extends Controller {

    public function processRequest($requestMethod, $requestParams=null)
    {        
        if('GET' === $requestMethod)
        {
            $gaussianCurve = new GaussianGenerator(
                $requestParams['mu'],
                $requestParams['theta'],
                $requestParams['minX'],
                $requestParams['maxX'],
                $requestParams['noDatapoints']
            );

            return $this->foundResponse($gaussianCurve->toArray());
        }
    }
}