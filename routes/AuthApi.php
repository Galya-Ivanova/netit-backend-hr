<?php

namespace routes;

class AuthApi {
    
    public function login() {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        if(\user\User::isAvailable($email, $password)) {

           $userObject = \user\User::login($email, $password);
            \user\User::set($userObject);
            
            echo json_encode($userObject);
            return;
        }
        
        echo "Authentication error";
    }
    
    public function registration() {
       //create new user and return success 
    }
    
    public function auth() {
        
    }
}