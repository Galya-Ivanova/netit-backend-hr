<?php

namespace routes;

class PostApi {
    
    public function index($id = null) {
        
        $collection = \models\JobPosts::fetch($id);       
        echo json_encode($collection);
    }
    
    public function group($id) {
        $collection = \models\JobPosts::fetchPostByGroup($id);       
        echo json_encode($collection);
    }
    
    public function search() {
       $collection = \models\JobPosts::search(array(
           'q'        => $_GET['q'],
           'searchBy' => $_GET['searchBy']
       ));
       echo json_encode($collection);
    }
    
    public function create() {
 
        $argumentCollection = array (
            'title'    => $_POST['jobs_title'],
            'firmname' => $_POST['firmname'],
            'content'  => $_POST['jobs_content'],
            'group'    => $_POST['job_group']
        );
        
        $jobId = \models\JobPosts::create($argumentCollection);
        //$jobId = \models\JobPosts::create($jobPostTitle, $jobPostFirmname, $jobPostContent); //POST
        
        if($jobId) {

            $collection = \models\JobPosts::fetch($recordID);
            echo json_encode($collection);
        }
        else {
            echo "Error";
        }
    }
    
    public function delete() {
        
        $Id        = $_POST['job_id'];
        $isDeleted = \models\JobPosts::delete($id);
        
        if($isDeleted) {
            echo "Success";
        }
        else {
            echo "Error";
        }
    }
}
