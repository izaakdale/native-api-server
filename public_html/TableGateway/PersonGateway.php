<?php

namespace TableGateway;

use PDO;

class PersonGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $statement = "SELECT * FROM person;";

        try {

            $result = $this->db->query($statement);
            $result = $result->fetch_all(MYSQLI_ASSOC);

            // $query = $this->db->query($statement);
            // $result = $query->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());            
        }
    }

    public function show($id)
    {
        $statement = "SELECT * FROM person WHERE id = $id;";

        try {

            $result = $this->db->query($statement);
            $result = $result->fetch_all(MYSQLI_ASSOC);

            // $query = $this->db->prepare($statement);
            // $query->execute(array($id));
            // $result = $query->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}


?>