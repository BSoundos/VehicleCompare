<?php
// Les fichiers utilisés : 
require_once('Views/diapoView.php');
require_once('Views/zone1View.php');
require_once('Views/zone2View.php');
require_once('Views/zone3View.php');
require_once('Views/loginView.php');

class acceuilView {

    public function head(){
        echo"
        
        <head>
            <meta charset='utf-8'>
            <title>Comparateur de véhicules</title>
            <link href='style.css' rel='stylesheet' type='text/css' />
            <script src='https://code.jquery.com/jquery-3.6.4.min.js'></script>
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
        $v = new loginView();
        $v->loginDisplay();
    }

    public function Diapo(){
        $v = new diapoView();
        $v->DiapoDisplay();
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
        $v = new zone1View();
        $v->Zone1Display();
    }

    public function Zone2($i,$version,$modele,$marque){
        $v = new zone2View();
        $v->Zone2Display($i,$version,$modele,$marque);
    }

    public function Zone3(){
        $v = new zone3View();
        $v->Zone3Display();
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