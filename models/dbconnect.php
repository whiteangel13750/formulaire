<?php

class DbConnect implements Crud {
    protected $pdo;
    protected $id;
    
    function __construct($id = null) {
        $this->pdo = new PDO(DATABASE, LOGIN, PASSWD);
        $this->id = $id;
    }
    
    function setId($id) {
        $this->id = $id;
    }
}
?>