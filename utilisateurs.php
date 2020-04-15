<?php

class Utilisateurs {
    public $idUtilisateur;
    public $pseudo;
    public $password;

    public function __construct(int $idUtilisateur, string $pseudo, string $password){
        $this->setIdUtilisateur($idUtilisateur);
        $this->setPseudo($pseudo);
        $this->setPassword($password);
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }

    
    public function getPseudo($pseudo) {
        return $this->pseudo;
    }
    
    public function setPseudo($pseudo) {
        $this->pseudo = $_POST['pseudo'];
    }

    public function getPassword($password) {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $_POST['password'];
    }

    public function save_user() {
        $file = file_get_contents("index.json");
        var_dump($file);
        $tab = json_decode($file, false, 512, 0);
        $unique = true;
        foreach($tab as $element){
            if ($element->pseudo== $this->pseudo){
                $unique=false;
            }
        }
        array_push($tab,["id"=>sizeof($tab)+1,"pseudo"=> $this->pseudo, "password" => $this->password]);
        if ($unique){
            array_push($tab, $file);
            file_put_contents('index.json', json_encode($tab));
        }
        
        
    }
   

    public function caracteristiques(){
        echo "Le pseudo" . " ". $this->pseudo ." ". "et son mot de passe " ." ". $this->password . ".";

    }
}

?>