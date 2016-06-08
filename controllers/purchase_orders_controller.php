<?php
  include_once dirname(__FILE__)."/../models/purchase_order.php";
  include_once "controller.php";

  class PurchaseOrdersController extends Controller {
    private $request;
    private $model;
    private $user;

    function __construct($request) {
      $this->request = $request;
      $this->model = new PurchaseOrder();
    }

    // Returns data about a specific purchase order
    public function show() {
      return $this->model->find($this->request["order_id"]);
    }
    
    public function setUserID($user_id){
        $this->user = $user_id;
    }
    
    public function requestAllPending(){
        return $this->model->get_all_pending();
    }
    
    public function update_pending_status($purchase_id){
        $this->model->update_pending_status($purchase_id);
    }
    
    public function requestMedia($media_id, $user_id, $license){
        $this->model->add_to_purchases($media_id, $user_id, $license);
    }

    // Returns a list of purchase orders for the given user
    public function index() {
      return $this->model->allPurchases($this->user);
    }
    
    public function indexSales(){
        return $this->model->allSales($this->user);
    }
  }
?>
