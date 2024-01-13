<?php
require_once 'Model/loginModel.php';
require_once 'Views/loginView.php';

class loginController {

    public function loginUser($username, $password) {

        $m = new LoginModel();
        $user = $m->get_user($username, $password);
        $user = $user->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            session_start();
            
           
            $_SESSION['username'] = $username;
            $_SESSION['authenticated'] = true;

            if ($user['role']=== 'admin'){
                $_SESSION['role'] = 'admin';
                header('Location: index.php?action=admin');
                exit();
            }
            else {
                header('Location: index.php');
                exit();
            }

        } else {
            header('Location: index.php?error=incorrect');
            exit();
    
        }
    }

    public function subscribeUser($user) {
        $m = new LoginModel();
        $r = $m->register_user($user);
        $this->loginUser( $user[4],$user[5]);
    }

    public function logoutUser() {
        session_start();
        session_unset(); 
        session_destroy(); 
        header('Location: index.php'); 
        exit();
    }


    public function loginGenerate() {
        $loginView = new loginView();
        $loginView->loginDisplay();
    }



}
?>