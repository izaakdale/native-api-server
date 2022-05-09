<?

require "TableMigration.php";
require "../Models/Product.php";

TableMigration::migrate(Product::$tableName, Product::$migrationColumns);

?>