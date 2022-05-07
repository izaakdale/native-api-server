<?

require "TableSeeder.php";
require "../Models/User.php";

$seederRows = [
    'columnNames' => User::$columnNames,
    'values' => [
        (new User('izaak', '28', '175', '70'))->toSqlRow() . ",",
        (new User('mahtab', '25', '165', '50'))->toSqlRow()
    ]
];

TableSeeder::seed(User::$tableName, $seederRows);

?>