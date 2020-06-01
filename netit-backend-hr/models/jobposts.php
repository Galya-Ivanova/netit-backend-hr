<?php

namespace models;

class JobPosts {
    //create
    //public static function create($title, $firmname, $content, $categoryId = null) {
    public static function create($argumentCollection) {
        
        $title    = $argumentCollection['title'];
        $firmname = $argumentCollection['firmname'];
        $content  = $argumentCollection['content'];
        $groupId  = $argumentCollection['group'];
        
        $query = "INSERT INTO hr.hr_jobs(title, firmname, content) "
                . "VALUES('{$title}', '{$firmname}', '{$content}')";
        
        \db\Database::getInstance()->query($query);
        $lastInsertedId = \db\Database::getInstance()->lastInsertedId();
        
        $query = "INSERT INTO hr.hr_group_job(job_id, group_id) "
                . "VALUES('{$lastInsertedId}', '{$groupId}')";
        
        \db\Database::getInstance()->query($query);
        return $lastInsertedId;
    }
    
    //update
    public static function update() {
        
    }
    
    //remove / delete
    public static function delete() {
        
       $query = "DELETE FROM hr.hr_jobs WHERE id = {$id}";
       \db\Database::getInstance()->query($query);
       
       return (\db\Database::getInstance()->affectedRows() == 1);
    }
    
    //fetch
    public static function fetch($id=null) {
       
        if(is_null($id)) {
            $query = "SELECT * FROM hr.hr_jobs";
        }
        else {
            $query = "SELECT * FROM hr.hr_jobs WHERE id = {$id}";
        }
        
        \db\Database::getInstance()->query($query);
        return \db\Database::getInstance()->fetchCollection();

    }
    
    public static function search($paramCollection) {
        
        $isSearchable = $paramCollection['q'] && $paramCollection['searchBy'];
        
        if($isSearchable) {
            
            $keyword = $paramCollection['q'];
            $column  = $paramCollection['searchBy'];
            $query   = "SELECT * FROM hr.hr_jobs WHERE $column LIKE '%$keyword%'";
            
            \db\Database::getInstance()->query($query);
            return \db\Database::getInstance()->fetchCollection();
        }
    }


    public static function fetchPostByGroup($groupId) {
        $query = "SELECT a.* FROM hr.hr_jobs a,
                                hr.hr_groups b,
                                hr.hr_group_job c
                          WHERE a.id = c.job_id 
                                and b.id = c.group_id
                                and b.id = $groupId";
        \db\Database::getInstance()->query($query);
        return \db\Database::getInstance()->fetchCollection();
    }
}

