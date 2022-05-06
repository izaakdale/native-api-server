<?

require "../bootstrap.php";

$statement = "INSERT INTO users (name, age, height) VALUES 
    ('Izaak', 28, 175.5),
    ('Mahtab', 25, 160.8)
;";

$dbConnection->query($statement);

?>