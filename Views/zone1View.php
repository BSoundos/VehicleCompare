<?php
// Les fichiers utilisés : 
require_once('Controller/marqueController.php');
require_once 'Controller/imageController.php';

class zone1View {

    public function Zone1Display(){

        echo "<div class='zone1'>";
             
        $controller = new marqueController();
        $r = $controller->get_firstx_marques_controller(5);
 
        foreach($r as $row){
           
            echo  '<a href='.$row["lien"].'><img src='.$row["image_lien"].' ></a>';
        }
        
        echo "</div>";
  
    }

 
       
    

}


?>