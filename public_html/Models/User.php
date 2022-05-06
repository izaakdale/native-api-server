<?


class User {
    
    public static $tableName = 'users';
    public $name, $age, $height;

    public function __construct($name, $age, $height)
    {
        $this->name = $name;
        $this->age = $age;
        $this->height = $height;
    }
}

?>