<?php

require_once 'model.php';

class Session extends Model {

    private $user_id;
    private $user_cookie = "user_id";
    private $session_cookie = "session_id";

    // SQL for saving session goes here
    public function save() {
        $sql = "UPDATE `sessions` SET `created_at`= CURRENT_TIMESTAMP WHERE session_id=" . $this->id;
        return self::query($sql);
    }

    // Find session from id
    public function find() {
        $sql = "SELECT * FROM sessions WHERE session_id =" . $this->id;
        return self::query($sql);
    }

    public function createCookie($user_id) {
        $user_cookie_value = $user_id;
        $time = time() + 3600;
        
        //create the session in DB
        //$this->create($user_id);
                //set the cookies
        setcookie($this->user_cookie, $user_cookie_value, $time); //3600 seconds = 1 hour
        //setcookie($this->session_cookie, $this->id, $time);

    }
    
    public function destroyCookie(){
        setcookie($this->user_cookie, "", time()-3600);//set expiration time to the past and cookie will expire
    }

    public function getCookie($request) {
        if (isset($request[$this->user_cookie])) {
            $time = time() + 3600;
            //get information from cookie about current session
            //$this->id = $request[$this->session_cookie];
            $this->user_id = $request[$this->user_cookie];

            //update the cookie expiration time
            setcookie($this->user_cookie, $this->user_id, $time); //3600 seconds = 1 hour
            //setcookie($this->session_cookie, $this->id, $time);
            //update current session in database
            //save();
        }

        //returns whether a cookie was loaded or not
        return $this->user_id;
    }

    // Creates a new session record for the user and returns the session_id from DB
    private function create($user_id) {
        $sql = "INSERT INTO `sessions`(`user_id`, `created_at`) VALUES (" . $user_id . ",CURRENT_TIMESTAMP)";
        self::query($sql);

        //retrive session_id from server
        $sql = "SELECT `session_id` FROM `sessions` WHERE `user_id` =" . $user_id .
                "ORDER BY DESC";
        $result = self::query($sql);
        //$row = $result->fetch_assoc();
        $this->id = $result['session_id'];

        return $this->id;
    }

    // Define what session records should look like in json format
    protected function format_record_response($record) {
        return '{"created_at" : "' . $record['created_at'] . '", "session_id" : "' . $record['session_id'] . '", "user_id" : "' . $record['user_id'] . '"},';
    }

}

?>
