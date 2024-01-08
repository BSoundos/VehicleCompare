<?php 

require_once('Controller/acceuilController.php');
require_once('Controller/comparateurController.php');
require_once('Controller/newsController.php');
require_once('Controller/marqueController.php');
require_once('Controller/vehiculeController.php');

$acceuil = new acceuilController();
$comparateur = new comparateurController();
$news = new newsController();
$marques = new marqueController();
$vehicules = new Vehicule_controller();

// Création d'un routeur.
if (!isset($_GET['action'])) {
    $acceuil->acceuilGenerate();
} else {
    $page = $_GET['action'];
    switch ($page) {

        case 'comparateur':
            $comparateur->comparateurGenerate();  
            break; 

        case 'news':
            if (isset($_GET['id'])) {
                $newsId = $_GET['id'];
                $news->newsDetailsGenerate($newsId);
            } else {
                $news->newsGenerate();
            }
            break ;

        case 'marques': 
            if (isset($_GET['id'])) {
                $marqueId = $_GET['id'];
                $marques->marqueDetailsGenerate($marqueId);
            } else {
                $marques->marquesGenerate(); 
            }
            break ;
             
            case 'vehicules': 
                if (isset($_GET['id'])) {
                    $vehiculeId = $_GET['id'];
                    $vehicules->vehiculeDetailsGenerate($vehiculeId);
                }
                break ;
                 
    }
}


?>
