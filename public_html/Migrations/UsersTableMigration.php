<? 
require "TableMigration.php";

$tableName = 'users';
$columns = [
    'name' => 'varchar(255)',
    'age' => 'int',
    'height' => 'float',
];

TableMigration::migrate($tableName, $columns);

?>