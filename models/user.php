<?php
    include "model.php";

    class User extends Model {
        protected $username;
        protected $email;
        protected $type;
        protected $fname;
        protected $lname;
        // SQL for saving media goes here
        public function save() {}

        // Find User from id and password, verify a user
        public function find($user_id) {
            $sql = "SELECT * FROM `users` WHERE `user_id` = ". $user_id;
            $transaction = self::query($sql);
            $results = $transaction->fetch_assoc();
            $this->id = $results['user_id'];
            $this->fname = $results['fname'];
            $this->lname = $results['lname'];
            $this->type = $results['type'];
            $this->username = $results['username'];
            $this->email = $results['email'];
            return $results;
        }
    
        public function all($type){
            $sql = "SELECT * FROM `users` WHERE `type` =". $type;
            $results = self::query($sql);
            return format_collection_response($results);
        }
    
        public static function verifyUser($username, $password){
            $sql = "SELECT * FROM `users` WHERE `user_id` = ". $username . " AND `password` = " . $password;
            $results = self::query($sql);
            $row = $results->fetch_assoc();
            $temp = new User();
            return $temp->format_record_response($row);
        }
    
        public function getType(){return $this->type;}

        public function setID($id){
            $this->id = $id;
            return self::find($id);
        }
        
        // Define what user records should look like in json format
        protected function format_record_response($record) {
            return '{"id" : "' . $record['user_id'] .'", "username" : "' . $record['username'] . '", "type" : "' . $record['type'] .'", "name" : "' . $record['fname'] . " " . $record['lname'] . '", "email" : "'.$record['email'].'"}';
        }
    }
?>
