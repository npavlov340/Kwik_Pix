<?php
    include "controllers/purchase_orders_controller.php";
    include "controllers/sessions_controller.php";
    
    $sessions_controller = new SessionsController($_COOKIE);
    $purchase_controller = new PurchaseOrdersController($_POST);
       $media_id = $_POST["media_id"];
       $license = $_POST["license_type"];
       $user_id = $sessions_controller->show();
    $result = $purchase_controller->requestMedia($media_id, $user_id, $license);
?>