<?php 

require_once('Controller/acceuilController.php');
require_once('Controller/comparateurController.php');
require_once('Controller/newsController.php');
require_once('Controller/marqueController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/avisController.php');
require_once('Controller/loginController.php');
require_once('Controller/adminController.php');
require_once('Controller/adminAjoutController.php');
require_once('Controller/adminModifController.php');
require_once('Controller/adminSuppController.php');
require_once('Controller/adminAutreController.php');
require_once('Controller/profileController.php');
require_once('Controller/conseilController.php');
require_once('Controller/contactController.php');



$acceuil = new acceuilController();
$comparateur = new comparateurController();
$news = new newsController();
$marques = new marqueController();
$vehicules = new Vehicule_controller();
$avis = new avisController();
$login = new loginController();
$admin = new adminController();
$admin_ajout = new adminAjoutController();
$admin_modif = new adminModifController();
$admin_supp = new adminSuppController();
$admin_manage = new adminAutreController();
$profile = new ProfileController();
$guide = new ConseilController();
$contact = new ContactController();




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
        case 'contact':
            if(isset($_GET['send'])){
                $name = $_POST["name"];
                $email = $_POST["email"];
                $message = $_POST["message"];

                $contact->sendEmail($name,$email,$message);
            }
            else{
                $contact->ContactDisplay();
            }

            break;

        case 'guide': 
            $guide->guideDisplay();
            break;

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
            if (isset($_GET['load'])){
                $avis->load();
               

            }
            elseif (isset($_GET['page'])){
                $avis->paginate();
               

            }
            elseif (isset($_GET['id']) && isset($_GET['type'])) {
                // afficher la page des avis // still mazal
                $targetId = $_GET['id'];
                $type = $_GET['type'];
                $avis->avisDetailsGenerate($targetId,$type);
            }
            elseif (isset($_GET['marque_id'])){
                // afficher la liste des voitures de cette marque (images + noms)
                // when an image is clicked ==> avisDetailsGenerate
                $id_marque = $_GET['marque_id'];
                $avis->avisInsideDisplay($id_marque);


            }
            elseif (isset($_POST["vehiculeAvis"])){
                // ajouter avis vehicule 

                $avis->ajoutVehiculeAvis($_POST);
                 
            }
            elseif (isset($_POST["marqueAvis"])){
                // ajouter avis marque 

                $avis->ajoutMarqueAvis($_POST);

            }
            else {
                $avis->avisPageDisplay();
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
        
        case 'profile':
            if (isset($_SESSION['id']) && isset($_GET['supp']) && isset($_GET['vehicule_id'])){
                // supp favoris
                $vehicules->suppFavoris($_GET['vehicule_id'],$_SESSION['id']);
                
            }
            elseif (isset($_SESSION['id']) && isset($_GET['add']) && isset($_GET['vehicule_id'])){
                // ajouter aux favoris 
                $vehicules->ajouterFavoris($_GET['vehicule_id'],$_SESSION['id']);

            }
            elseif(isset($_SESSION['id'])){ // connected user 
                $id = $_SESSION['id'];// the user access 
                $profile->profileGenerate($id);
                    
            }
            
                
            
            
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
        
        if (isset($_SESSION['role'])){
        
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                switch ($page) {

                    case 'vehicule': /*********************************  **************************** */
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {
                                case 'ajout' : 
                                    $id_marque = $_GET['id_marque'];
                                    $admin_ajout->ajoutGenerate($id_marque);
                                    break;

                                case 'modif' : 
                                    $Id = $_GET['id'];
                                    $admin_modif->modifGenerate($Id);
                                    break;

                                case 'supp' : 
                                    $Id = $_GET['id'];
                                    $id_marque = $_GET['id_marque'];
                                    $admin_supp->suppVehicule($Id,$id_marque);
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
                                $admin_modif->modifyVehicule($id,$vehicule,$image);

                            }
                            else { // ajout
                
                                $admin_ajout->ajoutVehicule($vehicule,$image);
                            }
                        }
                        else {
                            $id_marque = $_GET['id_marque'];
                            $admin->VehiculeAdminGenerate($id_marque);
                        }

                        break ; 

                    case 'marque': /********************************* marque **************************** */
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {

                                case 'ajout' : 
                                    $admin_ajout->ajoutMarqueGenerate();
                                    break;
                                case 'modif' : 
                                    $Id = $_GET['id'];
                                    $admin_modif->modifMarqueGenerate($Id);
                                    break;

                                case 'supp' : 
                                    $Id = $_GET['id'];
                                    $admin_supp->suppMarque($Id);
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
                                $admin_modif->modifyMarque($id,$marque,$image);

                            }
                            else { // ajout

                                $admin_ajout->ajoutMarque($marque,$image);
                            }
                
                           
                        }
                        else {
                            
                            $admin->marqueAdminGenerate();
                                 
                        }


                        break;

                    case 'modele':
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {
                                case 'ajout' : 
                                    $admin_ajout->ajoutModeleGenerate();
                                    break;
                                case 'supp' :
                                    if (!isset($_POST["id"])){
                                        $admin->deleteGenerate();
                                    } else {
                                        $Id = $_POST["id"];
                                        $admin_supp->suppModele($Id);
                                    }
                                    break;

                            }
                        }
                        else if (isset($_POST["submit"])) {
                            $modele = [
                                'nom'      => isset($_POST['nom']) ? $_POST['nom'] : null,
                                'marque_id'    => isset($_POST['marque_id']) ? $_POST['marque_id'] : null
                            ];

                            $admin_ajout->ajoutModele($modele);
        
                        }

                        break;

                    case 'version':

                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            switch ($tache) {
                                case 'ajout' : 
                                    $admin_ajout->ajoutVersionGenerate();
                                    break;
                                case 'supp' :
                                    if (!isset($_POST["id"])){
                                        $admin->deleteGenerate();
                                    } else {
                                        $Id = $_POST["id"];
                                        $admin_supp->suppVersion($Id);
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

                            $admin_ajout->ajoutVersion($version);
        
                        }
                        break;

                    case 'avis': 
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            if (isset($_GET['id'])){
                                $id =  $_GET['id'];
                            }
                            switch ($tache) {
                                case 'refus' : 
                                    
                                    $admin_manage->refusComment($id);
                                    break;
                                case 'bloque' :
                                    
                                    $admin_manage->bloqueUser($id);
                                    break;

                                case 'supp' : 
                                    $Id = $_GET['id'];
                                    $admin_supp->suppAvis($Id);
                                    break;

                                case 'valide' : 
                                    $Id = $_GET['id'];
                                    $admin_manage->valideAvis($id);
                                    break;

                                case 'filter' : 
                                    $admin_manage->filterAvis();
                                    

                                    break ; 
                            
                            }
                        }
                        else {
                                $admin->avisAdminGenerate();
                        }
                        break ; 

                    case 'news':
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            if (isset($_GET['id'])){
                                $Id = $_GET['id'];
                            }
                            switch ($tache) {

                                case 'ajout' : 
                                    $admin_ajout->ajoutNewsGenerate();
                                    break;

                                case 'modif' : 
                                   
                                    $admin_modif->modifNewsGenerate($Id);
                                    break;

                                case 'supp' : 
                                  
                                    $admin_supp->suppNews($Id);
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
                
                            $news = [
                                'diapo'  =>  isset($_POST['diapo']) ? $_POST['diapo'] : null,
                                'titre'  => isset($_POST['titre']) ? $_POST['titre'] : null,
                                'date'   => isset($_POST['date']) ? $_POST['date'] : null,
                                'contenu'   => isset($_POST['contenu']) ? $_POST['contenu'] : null,
                                'lien'           => isset($_POST['lien']) ? $_POST['lien'] : null,
                            ];

                            if (isset($_POST["id"])) {// perform update 

                                $id = isset($_POST['id']) ? $_POST['id'] : '';
                                $admin_modif->modifyNews($id,$news,$image);

                            }
                            else { // ajout

                                $admin_ajout->ajoutNews($news,$image);
                            }
                        }
                        else {
                            $admin->newsAdminGenerate();
                        }
                        break ;

                    case 'newsdetails':
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            if (isset($_GET['id'])){
                                $Id = $_GET['id'];
                            }
                            switch ($tache) {

                                case 'ajout' : 
                                    $admin_ajout->ajoutNewsDetailsGenerate($Id);
                                    break;

                                case 'modif' : 
                                   
                                    $admin_modif->modifNewsDetailsGenerate($Id);
                                    break;

                                case 'supp' : 
                                    $id_news = $_GET['id_news'];
                                    $admin_supp->suppNewsDetails($Id,$id_news);
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
                
                            $news = [
                                'text'  =>  isset($_POST['text']) ? $_POST['text'] : null,
                                'news_id' => isset($_POST['news_id']) ? $_POST['news_id'] : null,
                            ];

                            if (isset($_POST["id"])) {// perform update 

                                $id = isset($_POST['id']) ? $_POST['id'] : '';
                                $admin_modif->modifyNewsDetails($id,$news,$image);

                            }
                            else { // ajout
                              
                                $admin_ajout->ajoutNewsDetails($news,$image);
                            }
                        }
                        else {
                            if (isset($_GET['id'])){
                                $Id = $_GET['id'];
                            }
                            $admin->newsDetailsAdminGenerate($Id);
                        }
                        break;
                    

                    case 'user':
                        if (isset($_GET['tache'])) {
                            $tache = $_GET['tache'];
                            if (isset($_GET['id'])){
                                $id =  $_GET['id'];
                            }
                            switch ($tache) {
                                case 'valide' : 
                                    
                                    $admin_manage->valideUser($id);
                                    break;
                                case 'bloque' :
                                    
                                    $admin_manage->bloqueUser($id);
                                    break;

                                case 'filter' : 
                                    $admin_manage->filterUser();
                                    break ; 
                            
                            }
                        }
                        else {
                                $admin->usersAdminGenerate();
                        }
                        break ; 

                      
                }
            }
            else {
                $admin->pagePrincipalGenerate();
            }
        
        }
        else 
        {
            $acceuil->acceuilGenerate();
        }
             

    }
}


?>
