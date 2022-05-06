<?

require "TableMigration.php";
// require "../Models/User.php";

$tableName = 'products';
$migrationColumns = [
    'name' => 'varchar(255)',
    'price' => 'float',
];

TableMigration::migrate($tableName, $migrationColumns);

?>