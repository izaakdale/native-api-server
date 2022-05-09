<?php

namespace TableGateway;

// Controls the querying of the database for use in the controller. 
// Extraction allows changing engines or db types.
class Gateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index($tableName)
    {
        $statement = "SELECT * FROM $tableName;";

        $result = $this->db->query($statement);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        
        return $result;
    }

    public function show($tableName, $id)
    {
        $statement = "SELECT * FROM $tableName WHERE id = $id;";

        $result = $this->db->query($statement);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        
        return  $result;
    }

    public function delete($tableName, $id)
    {
        $statement = "DELETE FROM $tableName WHERE id = $id;";
        $result = $this->db->query($statement);
        return  $result;
    }
}


?>