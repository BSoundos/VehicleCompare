<?php 

require_once('Controller/acceuilController.php');

require_once('Controller/comparateurController.php');

$acceuil = new acceuilController();
$comparateur = new comparateurController();


// Création d'un routeur.
if (!isset($_GET['action'])) {
    $acceuil->acceuilGenerate();
} else {
    $page = $_GET['action'];
    switch ($page) {
        case 'comparateur':
            
            $comparateur->comparateurGenerate();  
            break; 
    }
}


?>
