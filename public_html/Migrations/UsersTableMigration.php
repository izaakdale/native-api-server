<?

require "TableMigration.php";
require "../Models/User.php";

TableMigration::migrate(User::$tableName, User::$migrationColumns);

?>