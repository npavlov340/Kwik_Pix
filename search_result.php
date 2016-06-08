<!--
    File Name: search_result.php
    Data: Apr 29 2016
    Description: Displays the search result image table
                 that is passed by search_request.js
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Search Result</title>
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
        header("X-XSS-Protection: 0"); // Enables onclick=showDialog() function in popup.php 
        
        include "controllers/media_controller.php";
        $controller = new MediaController($_GET);
        $result = $controller->index();
        
        
        // Create the search result text which contains the number of result and the search term
        $search_result_text;
        $num_of_images = substr_count($result, "{");
        switch ($num_of_images) {
            case 0: 
                $search_result_text = "Sorry, no results found for ... ";
                break;
            case 1: 
                $search_result_text = $num_of_images . " result found for ... ";
                break;
            default: $search_result_text = $num_of_images . " results found for ... ";
        }
            
        
    ?>
    
    <body>
        <div id="result-count-wrapper">
            <div id="result-count">
                <h3 class="results-header"><?php echo $search_result_text; ?> <em><u><?php echo $_GET["keywords"]; ?></u></em></h3>
            </div>
        </div>
        
        <div id="response"></div>
        <?php
            echo '<script type="text/javascript">'
                . 'debugger;'
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