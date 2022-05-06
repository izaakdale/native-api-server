<?

require "TableMigration.php";
require "../Models/User.php";

$migrationColumns = [
    'name' => 'varchar(255)',
    'age' => 'int',
    'height' => 'float',
];

TableMigration::migrate(User::$tableName, $migrationColumns);

?>