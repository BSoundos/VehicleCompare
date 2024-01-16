
<?php

require_once 'Views/contactView.php';
require_once 'Model/adminModel.php';

class ContactController {

    public function get_contact_email(){
        $m = new adminModel();
        $r = $m->get_params_spec('contact_email');

        return $r ; 

    }

    public function contactDisplay() {
        $v = new ContactView();
        $v->contactDisplay();

    }

    public function sendEmail($name,$email,$message){
       
        $msg = "First line of text\nSecond line of text";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail("soundouus1@gmail.com","My subject",$msg);

    }



}

?>

