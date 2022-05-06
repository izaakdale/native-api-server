<?php

namespace TableGateway;

// Controls the querying of the database for use in the controller. 
// Extraction allows changing engines or db types.
class UserGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $statement = "SELECT * FROM users;";

        $result = $this->db->query($statement);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        
        return $result;
    }

    public function show($id)
    {
        $statement = "SELECT * FROM users WHERE id = $id;";

        $result = $this->db->query($statement);
        $result = $result->fetch_all(MYSQLI_ASSOC);
        
        return  $result;
    }
}


?>