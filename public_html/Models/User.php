<?

class User {

    public string $name;
    public int $age; 
    public float $height;
    public float $weight;
    
    public static $tableName = 'users';  
    public static $migrationColumns = [
        'id' => 'INT NOT NULL AUTO_INCREMENT',
        'name' => 'varchar(255)',
        'age' => 'int',
        'PRIMARY KEY' => '(id)'
    ];

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
    
    public static function toSqlColumns()
    {
        $sqlColumnNames = '(';
        $migrationColumns = User::$migrationColumns;
        array_pop($migrationColumns);
        array_shift($migrationColumns);
        foreach($migrationColumns as $columnName => $columnType)
        {
            $sqlColumnNames .= "$columnName, ";
        }
        $sqlColumnNames = rtrim($sqlColumnNames, ", ") . ")";

        return $sqlColumnNames;

    }

    public function toSqlRow()
    {
        return "('$this->name', $this->age)";
    }
}

?>