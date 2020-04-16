<?php

class Utilisateurs {
    public $idUtilisateur;
    public $adresse;
    public $pseudo;
    public $password;

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }

    public function getAdresse($adresse) {
        return $this->adresse;
    }
    
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    
    public function getPseudo($pseudo) {
        return $this->pseudo;
    }
    
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getPassword($password) {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function save_user() {
        $file = file_get_contents("index.json");
        $tab = json_decode($file, false, 512, 0);
        $unique = true;
        foreach($tab as $element){
            if ($element->pseudo==$this->pseudo){
                $unique=false;
            }
        }
        if ($unique){
            array_push($tab,["id"=>sizeof($tab)+1,"pseudo"=> $this->pseudo, "password" => $this->password,"adresse" => $this->adresse ]);
            file_put_contents('index.json', json_encode($tab));
        }        
    }

    public function verify_user(){
        $file = file_get_contents("index.json");
        $tab1 = json_decode($file, false, 512, 0);
        foreach($tab1 as $element1){
            if ($element1->pseudo==$_POST['pseudo']&&password_verify($_POST['password'],$element1->password)){
                $_SESSION['id'] = $element1->id;
                $_SESSION['pseudo']= $_POST['pseudo'];
                $_SESSION['password']=$element1->password;
                header('Location:monespace.php');
            }else {
                echo "Connexion non OK";
                header('Location:index.php');
            }
        }
    }
}
?>