<?

require "TableSeeder.php";
require "../Models/User.php";

$seederRows = [
    'columnNames' => "(name, age, height)",
    'values' => [
        "('izaak', 28, 175.5),",
        "('mahtab', 25, 160)",
    ]
];

TableSeeder::seed(User::$tableName, $seederRows);



// will try this method another time
// $userList = [
//     new User('izaak', 28, 175.5),
//     new User('mahtab', 25, 160),
// ];

// $seederRows = [
//     'columnNames' => 
//     [
//         "name, age, height",
//     ],
//     'values' => [
//     ]
// ];

// foreach($userList as $user)
// [
//     $seederRows['values'][] = $user->toSqlValue();
// ]

// TableSeeder::seed(User::$tableName, $seederRows);

?>