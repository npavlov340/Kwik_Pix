<?php
    include "controllers/media_controller.php";

    $controller = new MediaController($_GET);
    $result = $controller->index();

    echo($result);
?>
