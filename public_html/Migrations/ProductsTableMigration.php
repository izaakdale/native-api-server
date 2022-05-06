<?

require "TableMigration.php";
require "../Models/Product.php";

$tableName = 'products';
$migrationColumns = [
    'name' => 'varchar(255)',
    'price' => 'float',
];

TableMigration::migrate(Product::$tableName, $migrationColumns);

?>