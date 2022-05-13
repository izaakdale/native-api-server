<?

class User {

    public string $name;
    public string $secret;
    
    public static $tableName = 'users';  
    public static $migrationColumns = [
        'id' => 'INT NOT NULL AUTO_INCREMENT',
        'name' => 'varchar(255) NOT NULL',
        'secret' => 'varchar(255) NOT NULL',
        'PRIMARY KEY' => '(id)'
    ];

    public function __construct($name, $secret)
    {
        $this->name = $name;
        $this->secret = $secret;
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
        return "('$this->name', '$this->secret')";
    }
}

?>