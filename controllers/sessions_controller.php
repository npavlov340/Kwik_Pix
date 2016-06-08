<?php

include_once dirname(__FILE__) . "/../models/session.php";
require_once "controller.php";

class SessionsController extends Controller {

    private $request;
    private $model;
    private $user_id;
    private $active = false; //every page will have a SessionsController but it will only use it if there is an active session

    function __construct($request) {
        if (isset($request["user_id"])) {
            $this->request = $request;
            $this->model = new Session();
            $this->active = true;
            //session can now use _COOKIE
        }
    }
    
    public function activeCookie(){
        return $this->active;  
    }

    // Find session record for the given session id
    public function show() {
        if($this->active){
            return $this->model->getCookie($this->request);
        }else{
            header("Location: login.php");
        }
    }

    // Create session for given user id
    public function create() {
        $this->model = new Session();
        $this->model->createCookie($this->user_id);
        $this->active = true;
    }
    
    public function setUserIdForNewCookie($user_id){
        $this->user_id = $user_id;
    }

    // Destroy session for given user id
    public function destroy() {
        $this->model->destroyCookie();
    }

}

?>
