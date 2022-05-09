<?
require_once "bootstrap.php";
require_once "TableMigration.php";
require_once "Models/User.php";

TableMigration::migrate(User::$tableName, User::$migrationColumns);

?>