<?

require "../bootstrap.php";

class TableMigration {

    public static function migrate($tableName, $columns)
    {
        global $dbConnection;
        $statement = "CREATE TABLE IF NOT EXISTS $tableName(";

        foreach ($columns as $columnName => $columnType) {
            $statement .= "$columnName $columnType, ";
        }

        // remove trailing ', ' from the for loop, add ); to end of statement
        $statement = rtrim($statement, ", ") . ");";
        $dbConnection->query($statement);
    }
    
}


?>