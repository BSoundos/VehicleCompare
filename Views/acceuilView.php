<?php
// Les fichiers utilisés : 
require_once('Controller/diaporamaController.php');
require_once('Controller/acceuilController.php');
require_once('Controller/loginController.php');

class acceuilView {

    public function head(){
        echo"
        
        <head>
            <meta charset='utf-8'>
            <title>Comparateur de véhicules</title>
            <link href='style.css' rel='stylesheet' type='text/css'/>
            <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css'>
            <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
            <script type='text/javascript' charset='utf8' src='https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js'></script>
            </head>
        ";
    }

    public function header(){
        echo"      
        <header>
        <div class='logo'>
            <img src='img/logo.png' alt='logo image'>
        </div>
        <div class='social-links'>
            <ul>
                <li><a href=''><img src='img/facebook.png' alt='Facebook'></a></li>
                <li><a href=''><img src='img/instagram.png' alt='Instagram'></a></li>
                <li><a href=''><img src='img/twitter.png' alt='Twitter'></a></li>
                <li><a href=''><img src='img/linkedin.png' alt='Twitter'></a></li>
            </ul>
        </div>
        <div class='register'>
        ";

        

        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
            echo"<a href='index.php?action=logout'>LOGOUT</a>";
        } 
        else {
            echo"<button id='loginLink'>LOGIN</button>";
            
        } 

        echo"</div>
        </header>
        ";

        $this->login();
    

    }

    public function login(){
        $c = new loginController();
        $c->loginGenerate();
    }

    public function Diapo(){
        $c = new diaporama_controller();
        $c->diapoGenerate();
    }

    public function Menu(){
        echo"      
        
        <div class='menu'>
            <ul>
                <li><a href='index.php'>Acceuil</a></li>
                <li><a href='index.php?action=news'>News</a></li>
                <li><a href='index.php?action=comparateur'>Comparateur</a></li>
                <li><a href='index.php?action=marques'>Marques</a></li>
                <li><a href='index.php?action=avis'>Avis</a></li>
                <li><a href='index.php?action=guide'>Guides d'achat</a></li>
                <li><a href='index.php?action=contact'>Contact</a></li>
            </ul>
        </div>
        
        ";
    }

    public function Zone1(){
        $c = new acceuilController();
        $c->zone1();
    }

    public function Zone2($i,$version,$modele,$marque){
        $c = new acceuilController();
        $c->zone2($i,$version,$modele,$marque);
    }

    public function Zone3(){
        $c = new acceuilController();
        $c->zone3();
    }

    public function footer(){
        
        echo "
        <footer>     
            <ul>
                <li><a href='index.php'>Acceuil</a></li>
                <li><a href='index.php?action=news'>News</a></li>
                <li><a href='index.php?action=comparateur'>Comparateur</a></li>
                <li><a href='index.php?action=marques'>Marques</a></li>
                <li><a href='index.php?action=avis'>Avis</a></li>
                <li><a href='index.php?action=guide'>Guides d'achat</a></li>
                <li><a href='index.php?action=contact'>Contact</a></li>
            </ul>
        </footer>
        ";
    }

    public function AcceuilDisplay(){
        echo"<!DOCTYPE html>
        <html>";
        $this->head();
        echo"<body>";
        $this->header();
        $this->Diapo();
        $this->Menu();
        echo"<section>";
        $this->Zone1();
        $this->Zone2(0,null,null,null);
        $this->Zone3();
        echo"</section>";
        //$this->footer();
        echo"</body></html>";
    }

}

?>