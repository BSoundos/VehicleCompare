
<?php
require_once 'Model/conseilModel.php';
require_once 'Views/guideView.php';

class ConseilController {

    public function getAllConseils(){
        $mtf = new ConseilModel();
        $r = $mtf->getAllConseils();

        return $r ; 
    }

    public function guideDisplay() {
        $v = new GuideView();
        $v->guideDisplay();

    }



}

?>

