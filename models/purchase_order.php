<?php
  include_once "model.php";

  class PurchaseOrder extends Model {

    // SQL for saving media goes here
    public function save() {}

    // Find PurchaseOrder from id
    public function find($id) {
        $sql = "SELECT * FROM `purchases` WHERE purchase_id = " . $id;
        return format_record_response(self::query($sql));
    }
    
    public function add_to_purchases($media_id, $user_id, $license){
        $sql = "INSERT INTO `purchases`(`media_id`, `user_id`, `license_type`, `date`) VALUES (". $media_id .",". $user_id .",'". $license ."',CURDATE())";
        self::query($sql);
    }
    
    public function update_pending_status($purchase_id){
        $sql = "UPDATE `purchases` SET `pending` = 0 WHERE `purchase_id` = $purchase_id";
        self::query($sql);
    }
    
    public function get_all_pending(){
        $sql = "SELECT * FROM `purchases` LEFT JOIN(`media) ON (purchases.media_id = media.media_id) WHERE `pending` = 1";
        return format_collection_response(self::query($sql));
    }

    // Return all purchase orders for a given user id
    public function allPurchases($user_id) {
        $sql = "SELECT * FROM `purchases` LEFT JOIN(`media`) ON (purchases.media_id = media.media_id) WHERE `user_id` = ". $user_id;
        return $this->format_collection_response(self::query($sql));
    }
    
    public function allSales($user_id){
        $sql = "SELECT * FROM `purchases` LEFT JOIN(`media`) ON (purchases.media_id = media.media_id) WHERE `artist_id`=" . $user_id;
        return $this->format_collection_response(self::query($sql));
    }

    // Define what purchase order records should look like in json format
    protected function format_record_response($record) {
       return '{"purchase_id" : "' . $record['purchase_id'] .'", "media_id" : "' . $record['media_id'] . '", "user_id" : "' . $record['user_id'] . '", "license_type" : "' . $record['license_type'] .'", "date" : "' . $record['date'] . '", "path" : "'.$record['path'].'", "pending" : "' .$record['pending'].'", "title" : "'.$record['title'] .'"},';
    }
  }
?>
