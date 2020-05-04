<?php

require 'utilisateurs.php';

class Tache {
    public $idTache;
    public $description;
    public $date;
    public $idUtilisateur;

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }

    public function getDescription($description) {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }

    
    public function getDate($date) {
        return $this->date;
    }
    
    public function setDate($date) {
        $this->date = $date;
    }

    public function getIdTache() {
        return $this->idTache;
    }

    public function setIdTache(int $id2) {
        $this->idTache = $id2;
    }

    public function save_tache() {
        $file = file_get_contents("tache.json");
        $tab = json_decode($file, false, 512, 0);
        array_push($tab,["idTache"=>sizeof($tab)+1,"idUtilisateur"=>$_SESSION['id'], "description"=> $this->description, "date" => $this->date]);
        file_put_contents('tache.json', json_encode($tab));       
    }
}

?>


