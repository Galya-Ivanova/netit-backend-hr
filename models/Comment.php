<?php

namespace models;

class Comment {
    
    public static function create ($paramCollection) {
        
        $job_id   = $paramCollection['job_id'];
        $content  = $paramCollection['content'];
        $employee = $paramCollection['employee'];
        
        $query = "INSERT INTO hr.hr_comments(job_id, content, employee)"
                . "VALUES({$job_id}, '{$content}', {$employee})";
                
        \db\Database::getInstance()->query($query);
        return \db\Database::getInstance()->lastInsertedId();
        
    }
    public static function fetch ($id=null) {
        
        $query = "SELECT * FROM hr.hr_comments";
        
        if($id) {
            $query = "SELECT * FROM hr.hr_comments WHERE id = {$id}";
        }
        \db\Database::getInstance()->query($query);
        \db\Database::getInstance()->fetchCollection(); 
    }
    public static function remove () {
        
    }
    public static function update () {
        
    }
    
    public static function fetchCommentByJobPostID($id) {
        $query = "SELECT * FROM hr.hr_comments WHERE job_id = {$id}";
        \db\Database::getInstance()->query($query);
        \db\Database::getInstance()->fetchCollection();
    }
}

