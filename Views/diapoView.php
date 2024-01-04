<?php
// Les fichiers utilisés : 
require_once('Controller/diaporamaController.php');
require_once ('Controller/imageController.php');

class diapoView {

    public function DiapoDisplay(){

        $controller = new diaporama_controller();
        $r = $controller->get_Diaporama_controller();
        $r = $r->fetchAll(PDO::FETCH_ASSOC);

        // get the first image 
        $controller = new image_controller();
        $image = $controller->get_image_controller($r[0]["image_id"]);
        $imageData = $image->fetch(PDO::FETCH_ASSOC);

        // display the first image with its link 
        echo 
        "<div id='container'>
            <a href=".$r[0]["lien"]."><img src=".$imageData["lien"]." ></a>
        </div>"; 
             
        
        //  add all the news images and links to the arrays news and images 
        echo "<script>
        let newsNumber = ". count($r). ";
        
        let news = []; 
        let images = [] ; 
        
        " ; 


        for ($i = 0; $i < count($r); $i++) {
            echo " news.push('".$r[$i]["lien"]."');" ;

            $image = $controller->get_image_controller($r[$i]["image_id"]);
            $imageData = $image->fetch(PDO::FETCH_ASSOC);

            echo " images.push('".$imageData["lien"]."');";

        }
        
        echo "
        let currentIndex = 1; 
        let container = document.getElementById('container');
    
        // Get the anchor element
        let a = container.firstElementChild;

        // Get the image element
        let img = a.firstElementChild;


        function changeImage() {
    
            // Get the news link  
            a.href = news[currentIndex];
    
            // Get the image URL 
            img.src = images[currentIndex];

            currentIndex++ ; 
            if (currentIndex >= newsNumber ) { currentIndex = 0 } ; 
        }
    
        // Call the function every 5 seconds
        setInterval(changeImage, 5000);


        </script>";
            
    }
       
    

}


?>