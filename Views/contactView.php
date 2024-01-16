<?php

// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');


class ContactView {

    private $acceuil_controller ;
    private $vehicule_controller ; 

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->vehicule_controller = new Vehicule_controller();
     
    }

    public function contactDisplay(){
        // infos personnelle 
        echo"<!DOCTYPE html>
        <html>";


        $this->acceuil_controller->head();
        echo"<body>";
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();


    
        
        
        echo "
        <div class='contact-info'>
        <h1>Contact Us</h1>
        <p>Email: <a href='mailto:ks_benni@esi.dz'>VehiculeCompInfo@gmail.com</a></p>
        <p>Phone: 0567553322</p>
        <p>Address:Algerie , Alger</p>
        </div>
       
       ";


        $this->acceuil_controller->footer();

        echo "</body></html>";



    }


}

?>