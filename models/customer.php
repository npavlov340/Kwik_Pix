<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include "user.php";
class Customer extends User {

    // SQL for saving media goes here
    public function save() {}

    // Return all purchases made by user
    public function all($type) {
        $sql = "SELECT * FROM `purchases` WHERE user_id = ".$type;
        return format_record_response(self::query($sql));
    }
    
    protected function format_record_response($record) {
        return '{"purchase_id" : "' . $record['purchase_id'] .'", "media" : "' . $record['media_id'] . '", "user_id" : "' . $record['user_id'] . '", "license" : "' . $record['license_type'] .'", "date" : "' . $record['date'] .'"},';
    }
  }

