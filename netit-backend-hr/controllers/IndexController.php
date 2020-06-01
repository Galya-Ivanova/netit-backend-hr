<?php

namespace controllers;

class IndexController {
    
    private $jobPostCollection = array();
    
    public function index() {
        $this->jobPostCollection = \models\JobPosts::fetch();

        if(isset($_GET) && isset($_GET['request']) && $_GET['request'] == 'data') {
            echo "Hello world";
        }
    }
    
    public function getJobPostCollection() {
        return $this->jobPostCollection;
    }
}
