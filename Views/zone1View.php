<?php
// Les fichiers utilisés : 
require_once('Controller/marqueController.php');
require_once 'Controller/imageController.php';

class zone1View {

    public function Zone1Display(){

        echo "<div class='zone1'>";
             
        $controller = new marque_controller();
        $r = $controller->get_Marques_controller();

        $controller = new image_controller();     
        foreach($r as $row){
            
            $image = $controller->get_image_controller($row["image_id"]);
            $imageData = $image->fetch(PDO::FETCH_ASSOC);
            echo  '<a href='.$row["lien"].'><img src='.$imageData["lien"].' ></a>';
        }
        
        echo "</div>";

     
    }
       
    

}


?>