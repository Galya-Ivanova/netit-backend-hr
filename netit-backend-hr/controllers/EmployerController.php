<?php

namespace controllers;

class EmployerController {
    
    public function index() {
        
        if(\user\User::isNotLoged()) {
            return redirect('index');
        }
        
        if(\user\User::isRegular()) {
            return redirect('index');
        }

        if(isset($_GET['action']) && $_GET['action'] == 'logout') {
            return $this->logout();
        }
        
        if(isset($_POST['post_tokken']) && $_POST['post_tokken'] == 1) {
            return $this->createJobPost();
        }
    }
    
    private function createJobPost() {
        
        $jobPostTitle    = $_POST['jobs_title'];
        $jobPostFirmname = $_POST['firmname'];
        $jobPostContent  = $_POST['jobs_content'];
        
        $jobId = \models\JobPosts::create($jobPostTitle, $jobPostFirmname, $jobPostContent); //POST
        
        if($jobId) {
            
            //TODO : check and solve the problem
            \session\Session::setFlashMessage('create_job_post', 'Новата обява е успешно създадена');
            redirect('employer'); // GET
            
        }
    }
    
    private function logout() {
        \user\User::logout();
        return redirect('index');
    }
}