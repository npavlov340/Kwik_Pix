<?php
    include "models/user.php";
    include "controllers/sessions_controller.php";
    $db = DataBase::get_instance(DataBase::$default_config);
    $sql = "SELECT * FROM `users` WHERE `password`= '".$_GET["Password"]."' AND `username`='".$_GET["Username"]."'";
    $transaction = $db->transaction($sql);
    $result = $transaction->fetch_assoc();
    //$row = mysqli_fetch_assoc($transaction);

    if(!$result['user_id']){
        header("Location: login.php?login_error=Invalid%20Username%20or%20Password"); 
        exit;
    }
    
    else {
        $user_id = $result['user_id'];
        $controller = new SessionsController($_COOKIE);
        $controller->setUserIdForNewCookie($user_id);
        $controller->create();
        echo "<p> user_id: ". $user_id . "</p>";
        header("Location: account.php"); 
        exit;
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/login.css">   
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 
        <link rel="stylesheet" type="text/css" href="css/search.css">   
    </head>    

    <!-- Include Search Bar -->

<?php include_once("navigation.php") ?>   
</html

    <?php include_once("navigation.php") ?>   
    <fieldset id="info" class="field">
    </fieldset>
</html>

