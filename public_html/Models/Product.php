<?

class Product {

    public string $name;
    public float $price;
    
    public static $tableName = 'products';  
    public static $migrationColumns = [
        'id' => 'INT NOT NULL AUTO_INCREMENT',
        'name' => 'varchar(255)',
        'price' => 'float',
        'PRIMARY KEY' => '(id)'
    ];

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
    
    public static function toSqlColumns()
    {
        $sqlColumnNames = '(';
        $migrationColumns = Product::$migrationColumns;
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
        return "('$this->name', $this->price)";
    }
}

?>