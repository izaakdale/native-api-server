<?

class TableSeeder {

    public static function seed($tableName, $seederRows)
    {
        global $dbConnection;
        $statement = "INSERT INTO $tableName " . $seederRows['columnNames'] . " VALUES ";

        foreach ($seederRows['values'] as $value) {
            $statement .= $value;
        }
        $statement .= ";";

        $dbConnection->query($statement);
    }
}

?>