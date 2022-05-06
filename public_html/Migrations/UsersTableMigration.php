<? 

require "../bootstrap.php";

$statement = "CREATE TABLE IF NOT EXISTS users
(
    id INT NOT NULL AUTO_INCREMENT,
    name varchar(255),
    PRIMARY KEY (id)
);";

$dbConnection->query($statement);

?>