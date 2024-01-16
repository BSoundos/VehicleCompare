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


    
        echo "<h1>Contact Us</h1>";
        
        echo "
        <form action='index.php?action=contact&send=1' method='post'>
            <label for='name'>Your Name:</label>
            <input type='text' id='name' name='name' required>

            <label for='email'>Your Email:</label>
            <input type='email' id='email' name='email' required>

            <label for='message'>Your Message:</label>
            <textarea id='message' name='message' rows='4' required></textarea>

            <button type='submit'>Submit</button>
        </form>
       
       ";


        //$this->acceuil_controller->footer();

        echo "</body></html>";



    }


}

?>