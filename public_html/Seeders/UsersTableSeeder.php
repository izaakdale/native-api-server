<?
require_once "bootstrap.php";
require_once "TableSeeder.php";
require_once "Models/User.php";

$seederRows = [
    'columnNames' => User::toSqlColumns(),
    'values' => [
        (new User('izaak', password_hash('secretI', PASSWORD_BCRYPT)))->toSqlRow() . ",",
        (new User('mahtab', password_hash('secretM', PASSWORD_BCRYPT)))->toSqlRow()
    ]
];

TableSeeder::seed(User::$tableName, $seederRows);

?>