<?php 

require_once('Controller/acceuilController.php');
require_once('Controller/comparateurController.php');
require_once('Controller/newsController.php');
require_once('Controller/marqueController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');
require_once('Controller/loginController.php');


$acceuil = new acceuilController();
$comparateur = new comparateurController();
$news = new newsController();
$marques = new marqueController();
$vehicules = new Vehicule_controller();
$avis = new avisController();
$login = new loginController();

session_start();

if (isset($_GET['error']) && $_GET['error'] === 'incorrect') {
    echo "<script>alert('Nom d\'utilisateur ou mot de passe incorrect.');</script>";
}


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

        case 'avis':
            if (isset($_POST["vehiculeAvis"])){
                // ajouter avis vehicule 



            }
            elseif (isset($_POST["marqueAvis"])){
                // ajouter avis marque 


            }
            elseif (isset($_GET['id']) && isset($_GET['type'])) {
                // afficher la page des avis 
                $targetId = $_GET['id'];
                $type = $_GET['type'];
                $avis->avisGenerate($targetId,$type);
            }
            
            break ;
        
        case 'login':
            
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
        
            $login->loginUser($username, $password);
            break;
        
        case 'logout':
        
            $login->logoutUser();
            break;

        case 'subscribe':

            if (isset($_POST["register"])) {
                $user=[
                    $nom=$_POST["nom"],
                    $prenom=$_POST["prenom"],
                    $sexe= $_POST['genre'],
                    $date_de_naissance=$_POST['date'],
                    $nom_utilisateur= $nom ."_". $prenom,
                    $mot_de_passe = $_POST['password'],
                    $statut = 'non valide',
                    $role = 'client'
                ];

                $login->subscribeUser($user);
            }
        
           
            break;

    }
}


?>
