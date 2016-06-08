<?php
    include dirname(__FILE__)."/../database/db.php";

    abstract class Model {
        protected $id;
        protected static $db;

        protected static function query($sql) {
            if (!isset($db)) { $db = DataBase::get_instance(DataBase::$default_config); }
            return $db->transaction($sql);
        }

        // SQL for saving records goes here
        abstract public function save();

        // Override in subclasses to define what records look like
        abstract protected function format_record_response($record);

        protected function format_collection_response($result) {
            $response = '[';
            while($row = $result->fetch_assoc()){
                $response .= $this->format_record_response($row);
            }
            $response = rtrim($response, ",") . ']';

            $result->free();
            return $response;
        }
    }
?>
