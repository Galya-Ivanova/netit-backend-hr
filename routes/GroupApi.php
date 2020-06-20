<?php

namespace routes;

class GroupApi {
    
    //get all groups
    public function index() {
        
        $collection = \models\Group::fetch();
        echo json_encode($collection);
    }
    
    public function update() {
        $groupId = $_POST['group_id'];
        $groupTitle = $_POST['group_title'];
        
        $response = \models\Group::update($groupId, $groupTitle);
        
        if($response) {
            echo "Success";
        }
        else {
            echo "Fail";
        }
    }
    
    public function delete() {
        $groupId = $_POST['group_id'];
        $response = \models\Group::delete($groupId);
        
        if($response) {
            echo "Success";
        }
        else {
            echo "Fail";
        }
    }
    
    //create new group
    public function create() {
        
        $groupTitle = $_POST['group_title'];
        $recordID = \models\Group::create($groupTitle, 1);
        
        if($recordID) {
                 
            $collection = \models\Group::fetch($recordID);
            echo json_encode($collection);
        }
        else {
            echo "Error";
        }
    }
}
