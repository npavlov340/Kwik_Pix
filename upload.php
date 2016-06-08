<?php
    include "models/artist.php";
    include "controllers/sessions_controller.php";

    $sessions_controller = new SessionsController($_COOKIE);
    $newID = $sessions_controller->show();
    $artist = new Artist();
    $artist->setID($newID);
    $result = $artist->upload($_FILES["fileToUpload"], $_POST["title"], $_POST["description"], $_POST["keywords"], $_POST['unlimited'], $_POST['web'], $_POST['print']);

    echo "File: ". $_FILES['fileToUpload']['name'];
    header("Location: landing.php");
?>

