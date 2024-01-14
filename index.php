<?php 

require_once('Controller/acceuilController.php');
require_once('Controller/comparateurController.php');
require_once('Controller/newsController.php');
require_once('Controller/marqueController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');
require_once('Controller/loginController.php');
require_once('Controller/adminController.php');
require_once('Controller/adminManageController.php');


$acceuil = new acceuilController();
$comparateur = new comparateurController();
$news = new newsController();
$marques = new marqueController();
$vehicules = new Vehicule_controller();
$avis = new avisController();
$login = new loginController();
$admin = new adminController();
$admin_manage = new adminManageController();

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

        case 'vehicules-carac':
            if (isset($_GET['id'])) {
                $vehiculeId = $_GET['id'];
                $vehicules->vehiculeCaracGenerate($vehiculeId);
            }
            break ;

        case 'avis':
            if (isset($_POST["vehiculeAvis"])){
                // ajouter avis vehicule 
                $vehiculeavis=[
                    'note' => $_POST['note'],
                    'commentaire' => $_POST['commentaire'],
                    'utilisateur_id' => $_POST['utilisateur_id'],
                    'target_id' => $_POST['target_id'] ,
                    'statut' => 'en attente',
                    'type' => 0                 
                ];

                $avis->ajoutVehiculeAvis($vehiculeavis);
                
            }
            elseif (isset($_POST["marqueAvis"])){
                // ajouter avis marque 
                $marqueavis=[
                    'note' => $_POST['note'],
                    'commentaire' => $_POST['commentaire'],
                    'utilisateur_id' => $_POST['utilisateur_id'],
                    'target_id' => $_POST['target_id'] ,
                    'statut' => 'en attente',
                    'type' => 1                 
                ];

                $avis->ajoutMarqueAvis($marqueavis);


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
        
        case 'admin':
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {

                    case 'vehicule': /*********************************  **************************** */
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {
                                case 'ajout' : 
                                    $admin_manage->ajoutGenerate();
                                    break;

                                case 'modif' : 
                                    $Id = $_GET['id'];
                                    $admin_manage->modifGenerate($Id);
                                    break;

                                case 'supp' : 
                                    $Id = $_GET['id'];
                                    $admin_manage->supp($page,$Id);
                                    break;

                            }
                        }
                        else if (isset($_POST["submit"])) {

                            if ($_FILES['image']['error'] !== 4) 
                            // aucun fichier selectionné 
                            // update case only (input without required)
                            {
                                $targetFolder = 'img/'; 
                                $targetFileName = $targetFolder . basename($_FILES['image']['name']);
                            
                                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFileName)) {
                                echo '<script> Console.log("File has been uploaded successfully.");</script>';
                                } else {
                                echo '<script> Console.log("Error uploading file.");</script>'; 
                                }

                                $image = $targetFileName;
                            }
                            else {
                                $image = null ; 
                            }
                
                            $vehicule=[
                                'nom' => $_POST['nom'],
                                'categorie' => $_POST['categorie'],
                                'marque_id' => $_POST['marque_id'],
                                'modele_id' => $_POST['modele_id'],
                                'version_id' => $_POST['version_id'],
                                'annee' => $_POST['annee'],
                                'tarif' => $_POST['tarif'],
                                'dimensions' => $_POST['dimensions'],
                                'moteur' => $_POST['moteur'],
                                'puissance' => $_POST['puissance'],
                                'consommation' => $_POST['consommation'],
                                'capacite' => $_POST['capacite'],
                                'autre_performances' => $_POST['autre_performances']                            
                            ];

                           


                            if (isset($_POST["id"])) {// perform update 

                                $id = isset($_POST['id']) ? $_POST['id'] : '';
                                $admin_manage->modifyVehicule($id,$vehicule,$image);

                            }
                            else { // ajout
                
                                $admin_manage->ajoutVehicule($vehicule,$image);
                            }
                        }
                        else {
                            $admin->VehiculeAdminGenerate();
                        }

                        break ; 

                    case 'marque': /********************************* marque **************************** */
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {
                                case 'gestion' :
                                    $admin->marqueAdminGenerate();
                                    break; 

                                case 'ajout' : 
                                    $admin_manage->ajoutLigneGenerate('marque');
                                    break;
                                case 'modif' : 
                                    $Id = $_GET['id'];
                                    $admin_manage->modifLigneGenerate('marque',$Id);
                                    break;

                                case 'supp' : 
                                    $Id = $_GET['id'];
                                    $admin_manage->supp($page,$Id);
                                    break;

                            }
                        }
                        else if (isset($_POST["submit"])) {


                            if ($_FILES['image']['error'] !== 4) 
                            // aucun fichier selectionné 
                            // update case only (input without required)
                            {
                                $targetFolder = 'img/'; 
                                $targetFileName = $targetFolder . basename($_FILES['image']['name']);
                            
                                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFileName)) {
                                echo '<script> Console.log("File has been uploaded successfully.");</script>';
                                } else {
                                echo '<script> Console.log("Error uploading file.");</script>'; 
                                }

                                $image = $targetFileName;
                            }
                            else {
                                $image = null ; 
                            }
                
                            $marque = [
                                'nom'            => isset($_POST['nom']) ? $_POST['nom'] : null,
                                'pays_origine'   => isset($_POST['pays_origine']) ? $_POST['pays_origine'] : null,
                                'siege_social'   => isset($_POST['siege_social']) ? $_POST['siege_social'] : null,
                                'annee_creation' => isset($_POST['annee_creation']) ? $_POST['annee_creation'] : null,
                                'lien'           => isset($_POST['lien']) ? $_POST['lien'] : null,
                            ];

                            if (isset($_POST["id"])) {// perform update 

                                $id = isset($_POST['id']) ? $_POST['id'] : '';
                                $admin_manage->modify($id,$marque,$image);

                            }
                            else { // ajout

                                $admin_manage->ajout($page,$marque,$image);
                            }
                
                           
                        }


                        break;

                    case 'modele':
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {
                                case 'ajout' : 
                                    $admin_manage->ajoutLigneGenerate('modele');
                                    break;
                                case 'supp' :
                                    if (!isset($_POST["id"])){
                                        $admin->deleteGenerate();
                                    } else {
                                        $Id = $_POST["id"];
                                        $admin_manage->supp($page,$Id);
                                    }
                                    break;

                            }
                        }
                        else if (isset($_POST["submit"])) {
                            $modele = [
                                'nom'      => isset($_POST['nom']) ? $_POST['nom'] : null,
                                'marque_id'    => isset($_POST['marque_id']) ? $_POST['marque_id'] : null
                            ];

                            $admin_manage->ajout($page,$modele,null);
        
                        }

                        break;

                    case 'version':

                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {
                                case 'ajout' : 
                                    $admin_manage->ajoutLigneGenerate('version');
                                    break;
                                case 'supp' :
                                    if (!isset($_POST["id"])){
                                        $admin->deleteGenerate();
                                    } else {
                                        $Id = $_POST["id"];
                                        $admin_manage->supp($page,$Id);
                                    }
                                    break;

                            }
                        }
                        else if (isset($_POST["submit"])) {
                            $version = [
                                'nom'      => isset($_POST['nom']) ? $_POST['nom'] : null,
                                'annee'      => isset($_POST['annee']) ? $_POST['annee'] : null,
                                'modele_id'    => isset($_POST['modele_id']) ? $_POST['modele_id'] : null
                            ];

                            $admin_manage->ajout($page,$version,null);
        
                        }
                        break;

                    case 'avis': 
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            $id =  $_GET['id'];
                            switch ($tache) {
                                case 'refus' : 
                                    $admin_manage->refusComment($id);
                                    break;
                                case 'bloque' :
                                    $admin_manage->bloqueUser($id);
                                    break;

                            }
                        }
                        else {
                        
                        $admin->avisAdminGenerate();
                        }
                    case 'news':
                        if (isset($_GET['id'])) {
                            $id =  $_GET['id'];
                            // details
                            $admin->newsDetailsAdminGenerate($id);
                        }
                        else {
                            $admin->newsAdminGenerate();
                        }


                }
            }
            else {
                $admin->pagePrincipalGenerate();
            }
            break; 

    }
}


?>
