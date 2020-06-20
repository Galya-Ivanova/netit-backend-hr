<?php

namespace controllers;

class LoginController {
    
    public function index() {
        
        if(isset($_POST) && isset($_POST['post_tokken'])) {
            $email    = $_POST['email'];
            $password = $_POST['password'];
            
            if(\user\User::isAvailable($email, $password)) {
                
               $userObject = \user\User::login($email, $password);
                \user\User::set($userObject);
                
                if(\user\User::role() == 1) {
                    redirect('index');
                }
                
                if(\user\User::role() == 2) {
                    header('Location: employer.php');
                }

            }
            
            \session\Session::setFlashMessage('error_message', 'Потребителят не е намерен в системата');
            
            //ako e false : return proper message  
//            $_SESSION['error_message'] = array(
//                'message'          => 'Потребителят не е намерен в системата',
//                'is_visible'       => true,
//                'background_color' => '#6495ed'
//            );
        }
    }
}
