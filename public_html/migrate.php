<?

if (isset($argv[1])) {
    // user passed an argument
    if('refresh' === $argv[1])
    {
        
    }
}
// die;

require_once "bootstrap.php";
require "Migrations/UsersTableMigration.php";
require "Migrations/ProductsTableMigration.php";

?>