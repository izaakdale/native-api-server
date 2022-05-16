<?

class GaussianGenerator {

    private $mu;
    private $theta;
    private $minX;
    private $maxX;
    private $noDatapoints;

    public function __construct($mu, $theta, $minX, $maxX, $noDatapoints)
    {
        $this->mu = $mu;
        $this->theta = $theta;
        $this->minX = $minX;
        $this->maxX = $maxX;
        $this->noDatapoints = $noDatapoints;
    }

    public function gauss($x)
    {
        $first = 1/($this->theta*sqrt(2*pi()));
        $second = exp((0-($x - $this->mu)**2) / (2*($this->theta**2)));

        return $first * $second;
    }

    public function toArray()
    {
        $arr = [];

        $interval = ($this->maxX - $this->minX) / $this->noDatapoints;
        for($x = $this->minX; $x <= $this->maxX; $x += $interval)
        {
            $x = round($x, 6);
            $arr[strval($x)] = $this->gauss($x);
        }
        return $arr;
    }

}