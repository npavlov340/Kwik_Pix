<!--
    File Name: landing.php
    Description: Represents as index.html for this website.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Kwik-Pix</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        <link rel="stylesheet" type="text/css" href="css/popup.css" />
        <link type="text/css" rel="stylesheet" href="jQuery/jquery-ui.min.css" />
        <link href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="jQuery/jquery-2.2.1.min.js"></script>
        <script type="text/javascript" src="jQuery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="jQuery/search_request.js"></script>
        <script type="text/javascript" src="jQuery/jquery.elevatezoom.js" ></script>
    </head>
    <?php 
        include_once("navigation.php");
        include "popup.php"; 
    ?>
    
    <body>
        <div id="content-wrapper">
            <div id="title-text">
                <img class="mast-head" src="css/MastHead.jpg">
            </div>
            <div id="landing-search-bar">
                <form class="navbar-form landing-search" method="get" action="search_result.php">
                    <div class="form-group landing-search-form input-group stylish-input-group">
                        <input type="text" class="form-control input-lg" id="landing-search-term" name="keywords" placeholder="Photos, people, places...">
                        <span class="input-group-btn">
                            <button type="submit" id="landing-search-button" class="btn btn-default btn-lg">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        
        <div id="response"></div>
        <?php
            include "controllers/media_controller.php";

            $controller = new MediaController($_GET);

            $result = $controller->latest();

            echo '<script type="text/javascript">'
                    . 'var table = createImageTable(\'' . $result . '\',3);'
                    . '$("#response").html(table);'
                    . '</script>';
        ?>
        
        <div class="arrows">
            <a href="javascript:void(0);" id="left-arrow">< Previous</a>
                &nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0);" id="right-arrow">Next ></a>
        </div>      
    </body>
    <?php include_once("footer.html") ?>
</html>
