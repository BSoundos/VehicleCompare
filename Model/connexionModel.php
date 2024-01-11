<?php

class connexion_model {

    private $db_name = "comparateur_vehicules";
    private $host = "127.0.0.1";
    private $user = "root";
    private $password = "";

    public function connexion(){

        $db_name = $this->db_name;
        $host = $this->host;
        $user = $this->user;
        $password = $this->password;
        
        $dsn="mysql:dbname=$db_name; host=$host;";
            try{
                    $c=new PDO($dsn,$user,$password);
            }
            catch(PDOException $ex){
                    printf("erreur de connexion à la base de donnée", $ex->getMessage());
                    exit();
            }
        return $c;
        
    }

    public function deconnexion(&$c){
        $c = null ;
    }

    public function requete($c,$r){
        return $c->query($r);
    }

   
}

?>