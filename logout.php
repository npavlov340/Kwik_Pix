<?php
    include_once 'controllers/sessions_controller.php';

    $controller = new SessionsController($_COOKIE);
    $controller->destroy();

    header("Location: landing.php");
?>


