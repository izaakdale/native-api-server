<?

require "TableSeeder.php";
require "../Models/Product.php";

$seederRows = [
    'columnNames' => Product::toSqlColumns(),
    'values' => [
        (new Product('Shirt', 29.99))->toSqlRow() . ",",
        (new Product('Jacket', 99.99))->toSqlRow() . ",",
        (new Product('Jeans', 49.99))->toSqlRow() . ",",
        (new Product('Hat', 20.99))->toSqlRow() . ",",
        (new Product('Scarf', 29.99))->toSqlRow() . ",",
        (new Product('Shoes', 89.99))->toSqlRow() . ",",
        (new Product('Tote', 34.99))->toSqlRow()
    ]
];

TableSeeder::seed(Product::$tableName, $seederRows);

?>