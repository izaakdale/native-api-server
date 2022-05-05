<?php

use TableGateway\PersonGateway;

require "./bootstrap.php";
require "./TableGateway/PersonGateway.php";

$personGate = new PersonGateway($dbConnection);

$all = $personGate->index();
$specific = $personGate->show(4);

print_r($specific);

?>