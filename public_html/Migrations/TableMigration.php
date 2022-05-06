<?

require "../bootstrap.php";

class TableMigration {

    public static function migrate($tableName, $columns)
    {
        global $dbConnection;
        $statement = "CREATE TABLE IF NOT EXISTS $tableName(id INT NOT NULL AUTO_INCREMENT, ";

        foreach ($columns as $columnName => $columnType) {
            $statement .= "$columnName $columnType, ";
        }

        $statement.=" PRIMARY KEY (id));";

        $dbConnection->query($statement);
    }
    
}


?>