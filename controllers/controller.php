<?php
    class Controller {
        private $request;
        protected $current_user_id;

        function __construct($request) {
          $this->request = $request;
        }

        public function index() { /* Returns collection of records */ }
        public function page() { /* Returns a paginated collection of records */ }
        public function show() { /* Returns specific record data */ }
        public function create() { /* Creates a record and saves it to the DB */ }
        public function update() { /* Updates a record and saves it to the DB */ }
        public function destroy() { /* Removes a record from the DB */ }
    }
?>
