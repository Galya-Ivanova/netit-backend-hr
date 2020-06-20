<?php

namespace models;

class Group {
    
    public static function create($title, $priority) {
        
        $query = "INSERT INTO hr.hr_groups(title, priority) "
                . "VALUES('{$title}', {$priority})";
        \db\Database::getInstance()->query($query);
        
        return \db\Database::getInstance()->lastInsertedId();
    }
    
    public static function update($id, $title) {
        $query = "UPDATE hr.hr_groups SET title = '{$title}' WHERE id = {$id}";
        \db\Database::getInstance()->query($query);
        
        return (\db\Database::getInstance()->affectedRows() == 1); 
    }
    
    public static function delete($id) {
        $query = "DELETE FROM hr.hr_groups WHERE id = {$id}";
        \db\Database::getInstance()->query("DELETE FROM hr.hr_groups WHERE id = {$id}");
        
        return (\db\Database::getInstance()->affectedRows() == 1); 
    }
    
    public static function fetch($id = null) {

        $query = ($id) ? "SELECT * FROM hr.hr_groups WHERE id = {$id}" 
                       : "SELECT * FROM hr.hr_groups";
        
        \db\Database::getInstance()->query($query);       
        return \db\Database::getInstance()->fetchCollection();
    }
}

