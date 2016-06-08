<?php
    include dirname(__FILE__)."/../models/media.php";
    include_once "controller.php";

    class MediaController extends Controller {
        private $request;
        private $model;

        function __construct($request) {
            $this->request = $request;
            $this->model = new Media();
        }

        public function show() {
            $media_path = $this->request["image_title"];
            return $this->model->find($media_path);
        }

        public function index() {
            $keywords = trim($this->request["keywords"]);
            $keywords_array = explode(" ", $keywords);

            return $this->model->all($keywords_array);
        }

        public function page() {
            if(isset($this->request["last_id"])) {
                return $this->model->older_than($this->request["last_id"], 9);
            } else if(isset($this->request["previous_id"])) {
                return $this->model->newer_than($this->request["previous_id"], 9);
            }
        }

        public function latest() {
            return $this->model->latest(6);
        }
    }
?>
