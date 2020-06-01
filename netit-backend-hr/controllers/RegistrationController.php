<?php

namespace controllers;

class RegistrationController {
    
    public function index() {
        
        if(isset($_POST) && isset($_POST['post_tokken'])) {
            $username = $_POST['username'];
            $email    = $_POST['email'];
            $password = $_POST['password'];
            
            if(\user\User::registration($username, $email, $password)) {
                echo "Success registration";
            }
        }

    }
}