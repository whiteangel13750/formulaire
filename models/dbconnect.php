<?php

// Il permet d'établir une connexion avec la base de donnée.
abstract class Dbconnect implements Crud {
    protected $pdo;
    protected $id;
    
    function __construct($id = null) {
        $this->pdo = new PDO(DATABASE, LOGIN, PASSWD);
        $this->id = $id;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    abstract function selectAll();
    abstract function insert();
    abstract function select();
    abstract function update();
    abstract function delete();
}
?>