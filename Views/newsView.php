<?php
// Les fichiers utilisés :
require_once('Controller/acceuilController.php');
require_once('Controller/vehiculeController.php');

class newsView {

    private $acceuil_controller ;
    private $news_controller ; 
    private $image_controller ; 

    
    public function __construct() {
        $this->acceuil_controller = new acceuilController();
        $this->news_controller = new newsController();
        $this->image_controller = new image_controller();
    }


    // pour la page des news 
    public function newsDisplay() {
        

        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();


        $r = $this->news_controller->get_news_controller();

        echo "<div class='news-container'>";

        foreach($r as $row){
            
            echo "<div class='news-item' >";
            echo "<div class='paragraph-content'><h3>".$row['titre']."</h3>";
            echo "<p>".$row['contenu']." <a href='index.php?action=news&id=".$row['id']."'>Read More</a> </p></div>";
            $image = $this->image_controller->get_image_controller($row["image_id"]);
            $imageData = $image->fetch(PDO::FETCH_ASSOC);
            echo  '<div class="image"><img src='.$imageData["lien"].' ></div></div>';
        }

        echo "</div>";
      
        

        
        //$this->acceuil_controller->footer();
        
        echo"</body></html>";
    }


    // pour la page des détails d'un des news 
    public function newsDetailsDisplay($newsId){
        echo"<!DOCTYPE html>
        <html>";

        $this->acceuil_controller->head();
        $this->acceuil_controller->header();
        $this->acceuil_controller->Menu();


        $r = $this->news_controller->get_news_details($newsId);

        echo "<div class='news-container'>";

        foreach($r as $row){
            
            echo "<div class='news-item' >";
            echo "<div class='paragraph-content'>";
            echo "<p>".$row['text']."</p></div>";
            $image = $this->image_controller->get_image_controller($row["image_id"]);
            $imageData = $image->fetch(PDO::FETCH_ASSOC);
            echo  '<div class="image"><img src='.$imageData["lien"].' ></div></div>';
        }

        echo "</div>";
      
        

        
        //$this->acceuil_controller->footer();
        
        echo"</body></html>";

    }

}
?>
