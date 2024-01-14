<?php
// Les fichiers utilisés : 
require_once('Controller/acceuilController.php');
require_once('Controller/adminController.php');
require_once('Controller/vehiculeController.php');
require_once('Controller/newsController.php');


class NewsAdminView {

    private $acceuil_controller ;
    private $admin_controller ;
    private $vehicule_controller;
    private $avisController;

    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->admin_controller = new adminController();
        $this->vehicule_controller = new Vehicule_controller();
        $this->newsController = new newsController();
    }

    public function newsDisplay(){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();


        $this->displayTable();


        
        //$this->acceuil_controller->footer();

        echo "</div></body></html>";
    }


 
    public function displayTable(){

            $r = $this->newsController->get_news_controller(); 
            $r = $r->fetchAll(PDO::FETCH_ASSOC);
    
    
    
            // the table 
           echo "
           <div class='table-admin'>
                <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Lien</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>";
    
                foreach($r as $row){
                
                    echo"
                        <tr>
                            <td>".$row['id']."</td> 
                            <td><img src =".$row['image_lien']." ></td>
                            <td>".$row['titre']."</td>
                            <td>".$row['contenu']."</td>
                            <td>".$row['date']."</td>
                            <td>".$row['lien']."</td>
                            <td> 
                            <a href='index.php?action=admin&page=news&id=".$row['id']."' >Voir details</a>
                            </td>
                    
                        </tr>";
    
                }
                    
                echo"
                </tbody>
                </table></div>";
    
    
            
    }


    public function newsDetailsDisplay($id){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();

        $this->admin_controller->manageLinksGenerate();


        $this->displayTableDetails($id);


        
        //$this->acceuil_controller->footer();

        echo "</div></body></html>";

    }
    
    public function displayTableDetails($id){

        $r = $this->newsController->get_news_details($id); 
        $r = $r->fetchAll(PDO::FETCH_ASSOC);



        // the table 
       echo "
       <div class='table-admin'>
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID news</th>
                    <th>Text</th>
                    <th>Image</th>
                    <th>Gestion</th>
                </tr>
            </thead>
            <tbody>";

            foreach($r as $row){
            
                echo"
                    <tr>
                        <td>".$row['id']."</td> 
                        <td>".$row['news_id']."</td>
                        <td>".$row['text']."</td> 
                        <td><img src =".$row['image_lien']." ></td>
        
                        <td> 
                        <a href='index.php?action=admin&page=newsdetails&id=".$row['id']."' >gestion</a>
                        </td>
                
                    </tr>";

            }
                
            echo"
            </tbody>
            </table></div>";


        
}

   

}

?>