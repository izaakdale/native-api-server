<?
require_once "bootstrap.php";
require_once "TableMigration.php";
require_once "Models/Product.php";

TableMigration::migrate(Product::$tableName, Product::$migrationColumns);

?>