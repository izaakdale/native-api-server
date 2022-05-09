<?

require "TableSeeder.php";
require "../Models/User.php";

$seederRows = [
    'columnNames' => User::toSqlColumns(),
    'values' => [
        (new User('izaak', 28))->toSqlRow() . ",",
        (new User('mahtab', 25))->toSqlRow()
    ]
];

TableSeeder::seed(User::$tableName, $seederRows);

?>