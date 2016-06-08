<?php
    include dirname(__FILE__)."/../models/user.php";
    include "controller.php";

    class UserController extends Controller {
        private $request;
        private $model;

        function __construct($request) {
        $this->request = $request;
        $this->model = new User();
        }

        // Returns data about a specific user, $id will be retrieved from cookie
        public function show($id) {
            return $this->model->find($id);
        }

        // Returns a list of users of the given type
        public function index() {
            return $this->model->all($this->request["type"]);
        }   
    }
?>
