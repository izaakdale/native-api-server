<?

require "../bootstrap.php";

$statement = "INSERT INTO users (name) VALUES 
    ('Izaak'),
    ('Mahtab')
;";

$dbConnection->query($statement);

?>