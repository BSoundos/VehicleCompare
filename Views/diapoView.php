<?php
// Les fichiers utilisés : 
require_once('Controller/diaporamaController.php');
require_once ('Controller/imageController.php');

class diapoView {

    public function DiapoDisplay(){

        $controller = new diaporama_controller();
        $r = $controller->get_Diaporama_controller();
        $r = $r->fetchAll(PDO::FETCH_ASSOC);

        // display the first image with its link 
        echo 
        "<div id='container'>
            <a href='index.php?action=news&id=".$r[0]['id']."'><img src=".$r[0]["image_lien"]." ></a>
        </div>"; 
             
        
        //  add all the news images and links to the arrays news and images 
        echo "<script>
        let newsNumber = ". count($r). ";
        
        let news = []; 
        let images = [] ; 
        
        " ; 


        for ($i = 0; $i < count($r); $i++) {
            echo " news.push('index.php?action=news&id=".$r[$i]['id']."');" ;

            echo " images.push('".$r[$i]["image_lien"]."');";

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