<script type="text/javascript" src="jQuery/jquery.elevatezoom.js" ></script>

<!--
 File Name: navigation.php
 Description: This script for the fixed navigation bar.
-->
<?php

include_once "controllers/sessions_controller.php";
$sessions = new SessionsController($_COOKIE);

?>
<link rel="stylesheet" type="text/css" href="css/navigation.css" />

<nav  class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
    <div class="navbar-header">
        <a class="navbar-brand" href="landing.php"><img src="images/Logo_xSmall.png"></a>
    </div>
    
    <div class="navbar-collapse collapse" id="navbar-collapsible">      
        <ul class="nav navbar-nav navbar-right">
            <?php
                if($sessions->activeCookie()){
                    echo '<li><a href="account.php">My Account</a></li>';
                    echo '<li><a href="logout.php">Sign Out</a></li>';
                }else{
                     echo '<li><a href="login.php">Login</a></li>';
                }
            ?>            
        </ul>
      
        <form class="navbar-form" action="search_result.php" method="get">
                <input type="text" class="form-control" id="search-term" name="keywords" placeholder="Photos, people, places...">
                <button type="submit" id="search-button" class="btn btn-default btn-group btn-sm">Search</button>    
        </form>
    </div>
</nav>
