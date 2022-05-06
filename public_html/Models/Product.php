<?

class Product {
    
    public static $tableName = 'products';
    public $name, $price;

    public function __construct($name, $age, $height)
    {
        $this->name = $name;
        $this->age = $age;
        $this->height = $height;
    }
}

?>