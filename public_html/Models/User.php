<?

class User {
    
    // migration
    public static $tableName = 'users';  
    public static $migrationColumns = [
        'name' => 'varchar(255)',
        'age' => 'int',
        'height' => 'float',
        'weight' => 'float',
    ];

    // seeding
    public static $columnNames = '(name, age, height, weight)';  
    public string $name;
    public int $age; 
    public float $height;
    public float $weight;

    public function __construct($name, $age, $height, $weight)
    {
        $this->name = $name;
        $this->age = $age;
        $this->height = $height;
        $this->weight = $weight;
    }

    public function toSqlRow()
    {
        return "('$this->name', $this->age, $this->height, $this->weight)";
    }
}

?>