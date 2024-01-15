<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');
require_once('Controller/vehiculeController.php');


class marqueAdminView{

    private $acceuil_controller ;
    private $admin_controller ;
    private $marque_controller;
    private $version_controller ; 

    private $modeleController;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->marque_controller = new marqueController();
        $this->modeleController = new Modele_controller();
        $this->version_controller = new Version_controller();
    }

    public function marqueDisplay(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();

        echo "<div class='links' align='center'>
        <a href='index.php?action=admin&page=marque&tache=ajout'>Ajouter une marque</a>
        <a href='index.php?action=admin&page=modele&tache=ajout'>Ajouter un modele</a>
        <a href='index.php?action=admin&page=version&tache=ajout'>Ajouter une version</a>
        <a href='index.php?action=admin&page=version&tache=supp'>Supprimer un modele ou une version</a>
        
        </div>";

        $this->displayTable();


        
        //$this->acceuil_controller->footer();

        echo "</div></body></html>";
    }

    public function displayTable(){
        $r = $this->marque_controller->get_Marques_controller(); 
        $r = $r->fetchAll(PDO::FETCH_ASSOC);


        // the table 
       echo "
       <div class='table-admin'>
            <table>
            <thead>
                <tr>
                    <th></th>";
                    foreach ($r as $row) {
                        foreach ($row as $field => $value) {
                            if ($field === 'id' || $field === 'image_lien'  || $field === 'image_id') {
            
    
                            }
                            else {
                                echo "<th>".$field."</th>";
                            }
            
                        }
                        break;
                    }
                echo "
                <th>Gestion marque</th>
                <th>Gestion vehicules</th>
                </tr>
            </thead>
            <tbody>";

            foreach($r as $row){
            
                echo"
                    <tr>
                        <td><img src='".$row['image_lien']."' ></td>
                        <td>".$row['nom']."</td>
                        <td>".$row['pays_origine']."</td>
                        <td>".$row['siege_social']."</td>
                        <td>".$row['annee_creation']."</td>
                        <td><a href='".$row['lien']."'>lien</a></td>
                        <td> 
                        <a href='index.php?action=admin&page=marque&tache=modif&id=".$row['id']."' >Modifier marque</a>
                        <a href='index.php?action=admin&page=marque&tache=supp&id=".$row['id']."' >Supprimer marque</a>
                        </td>
                        <td>
                        <a href='index.php?action=admin&page=vehicule&id_marque=".$row['id']."' >Gestion vehicules</a>
                        </td>
                
                    </tr>";

            }
                
            echo"
            </tbody>
            </table></div>";


        
    }

    public function deleteView(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();

        echo "<div class='links' align='center'>

        <form action='index.php?action=admin&page=modele&tache=supp' method='post'>
            <label for='select-models'>Sélectionner un modele à supprimer :</label>
            <select id='select-models' name='id'>";
                
                    $modeles = $this->modeleController->get_Modeles_controller();
                    $modeles = $r->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($modeles as $modele) {
                        echo '<option value='.$modele['id'].'>'.$modele['nom'].'</option>';
                    }
                
            echo"</select>
            <button type='submit' >Supprimer</button>
        </form>

        <form action='index.php?action=admin&page=version&tache=supp' method='post'>
            <label for='version_select'>Sélectionner une version à supprimer :</label>
            <select id='version_select' name='id'>";
                
                    $modeles = $this->version_controller->get_versions_controller();
                    $modeles = $r->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($modeles as $modele) {
                        echo '<option value='.$modele['id'].'>'.$modele['nom'].'</option>';
                    }
                
            echo"</select>
            <button type='submit' >Supprimer</button>
        </form>

        
        </div>";

        //$this->acceuil_controller->footer();

        echo "</div></body></html>";

    }
}

?>