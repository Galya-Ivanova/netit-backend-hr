<?php

namespace user;

class User {
    
    //public static $username = null;
    //public static $email    = null;
    //public static $role     = null;
    //public static $isLoged  = false;
    
    public static function username() {
        return $_SESSION['user_reference']['username'];
    }
    
    public static function email() {
        return $_SESSION['user_reference']['email'];
    }
    
    public static function role() {
        return $_SESSION['user_reference']['role'];
    }
    
    public static function isLoged() {
        return isset($_SESSION['user_reference']);
    }
    
    public static function isNotLoged() {
        return !self::isLoged();
    }
    
    public static function isEmployer() {
        return (self::role() == 2);
    }
    
    public static function isRegular() {
        return self::role() !=2 &&
               self::role() == 3;
    }
    
    public static function set($userObject) {
        
        $_SESSION['user_reference'] = $userObject;
        
//        User::$username = $userObject['username'];
//        User::$email    = $userObject['email'];
//        User::$role     = $userObject['role'];
//        User::$isLoged  = true;
    }

    public static function login($email, $password) {

        
        if(User::isAvailable($email, $password)) {
                    
            \db\Database::getInstance()->query("SELECT * FROM hr.users where email = '{$email}' and password = '{$password}'");
            $userObject  = \db\Database::getInstance()->fetch();
         
            
            $userRole            = $userObject['role'];
            \db\Database::getInstance()->query("SELECT resource FROM hr.hr_http_resources WHERE role = {$userRole}");
            $permitionCollection = \db\Database::getInstance()->fetchCollection();
            $userObject['permitions'] = $permitionCollection;

            return $userObject;
        }
        
        return false;
    }
    
    public static function isAvailable($email, $password) {

        
        \db\Database::getInstance()->query("SELECT COUNT(*) AS number_of_rows FROM hr.users where email = '{$email}' and password = '{$password}'");
        $collection = \db\Database::getInstance()->fetch();
        
        return ($collection['number_of_rows'] == 1);
    }
    
    //NB : return User object
    //NB : who is going to manage the session???
    public static function registration($username, $email, $password) {
        
        \db\Database::getInstance()->query("INSERT INTO hr.users(username, email, password, role)
                                       VALUES('{$username}', '{$email}', '{$password}', 1)");
        
        if(\db\Database::getInstance()->lastInsertedId()) {
            return true;
        }
        return false;
    }
    
        public static function logout() {
        session_destroy();
    }
   
}
