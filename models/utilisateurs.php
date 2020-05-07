<?php

// Demarre une session utilisateur
session_start();

// La classe instancie un nouvel utilisateur. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Utilisateurs extends Dbconnect {
    private $idUtilisateur;
    private $adresse;
    private $pseudo;
    private $password;

// Le construct permet d'établir une structure de notre utilisateur
    function __construct($id=null) {
        parent::__construct($id);
    }

// La syntaxe get permet de lier une propriété d'un objet à une fonction qui sera appelée lorsqu'on accédera à la propriété.
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
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

    // Permet d'enregistrer un utilisateur en encodant le fichier json. Unique permet de vérifier si le pseudo et le password
    // existe déja ou non.

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

     // Permet de vérifier si un utilisateur est dans le fichier json. 

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
                header('Location:index.php');
            }
        }
    }

    // Permet d'inserer un utilisateur dans la base de donnée. 

public function insert(){
    var_dump($this);
    $query1 = "INSERT INTO utilisateur(PSEUDO,PASSWORD) VALUES ('$this->pseudo','$this->password')";
    $result1 = $this->pdo->prepare($query1);
    $result1->execute();
    $this->idUtilisateur = $this->pdo->lastInsertId();
    return $this;
}

  // Permet de selectionner tous les utilisateurs dans la base de donnée. 

public function selectAll(){
        $query ="SELECT * FROM utilisateur;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas= $result->fetchAll();

        $tab=[];

        foreach($datas as $data) {
            $current = new Utilisateurs();
            $current->setId($data['IDUTILISATEUR']);
            array_push($tab, $current);
            }
            return $tab;

    }

// Permet de selectionner un utilisateurs dans la base de donnée. 
    
public function select(){
    $query2 = "SELECT * FROM utilisateur WHERE IDUTILISATEUR = $this->idUtilisateur;";
    $result2 = $this->pdo->prepare($query2);
    $result2->execute();
    $data2 = $result2->fetch();
            //appel aux setters de l'objet
        return $this;
    }

// Permet de modifier un utilisateur dans la base de donnée. 
    public function update(){

    }

// Permet de supprimer un utilisateur dans la base de donnée. 
   public function delete(){
        
    }
}
?>