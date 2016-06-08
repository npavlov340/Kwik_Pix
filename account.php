<?php
include "controllers/users_controller.php";
include "controllers/sessions_controller.php";
include "controllers/purchase_orders_controller.php";
$sessions_controller = new SessionsController($_COOKIE);
$users_controller = new UserController($_GET);
//$media_controller = new MediaController($_GET);
//$session_result = $sessions_controller->show();
$user_id = $sessions_controller->show();
$user_result = $users_controller->show($user_id);

$fname = $user_result['fname'];
$lname = $user_result['lname'];
$fullname = $fname . " " . $lname;
$username = $user_result['username'];
$type = $user_result['type'];
$email = $user_result['email'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Account Information</title>
        <link rel="stylesheet" type="text/css" href="css/login.css" />   
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" /> 
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        <script type="text/javascript" src="jQuery/account_request.js"></script>


        <style type="text/css">
            .tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}

            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}

            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}

            .tg .tg-a2cf{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center;vertical-align:top}

            .tg .tg-baqh{text-align:center;vertical-align:top}

            .tg .tg-41e9{background-color:#C2FFD6;font-weight:bold;text-align:center;vertical-align:top}

            .tg .tg-rmb8{background-color:#C2FFD6;vertical-align:top}

            .tg .tg-0l6a{background-color:#C2FFD6;text-align:center;vertical-align:top}

            .tg .tg-yw4l{vertical-align:top}

            .tg .tg-3mlp{background-color:#C2FFD6;font-weight:bold;vertical-align:top}
        </style>



    </head>
    <!-- Include Search Bar -->
    <?php include_once("navigation.php") ?>     

    <!-- Create the login form, get user data and compare with Database-->    
    <body style="margin:50;padding:50">
        <div class="row" align="left">
            <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">
               <?php echo '<H2> Account Information - '.$fullname.'</H2> '?>
                <p>Click on the fields to change your information.</p>
        </div>
        <div class="row" align="left"><p>
                <label for="name">Name:</label><br />
                <?php echo '<input id="name" class="input" name="name" type="text" value="' . $fullname . '" size="30" /><br />' ?>
        </div>
        <div class="row" align="left"><p>
                <label for="email">Email:</label><br />
                <?php echo '<input id="email" class="input" name="email" type="text" value="' . $email . '" size="30" /><br />' ?>
        </div>
        <br>
        <div class="row" align="left">
            <input class="btn btn-primary" id="submit_button" type="submit" value="Submit changes" />
        </div>
    </form>                     
    <br>
    <?php
    if ($type == "artist") {
        echo '<form action="upload_page.php" method="post">
        <div class="row" align="left">
            <label for="upload">Upload a new image (500mb maximum)</label><br />
            <input class="btn btn-primary" id="upload_button" type="submit" value="Upload Image" />
        </div>
    </form>
    <br><br><br>';
    }

    $purchase_controller = new PurchaseOrdersController($_GET);
    $purchase_controller->setUserID($user_id);
    $purchases = $purchase_controller->index();
    $purchases_table = displayPurchases($purchases, false);
    echo $purchases_table;

    echo '<br><br>';

    if ($type == "artist") {
        $sales = $purchase_controller->indexSales();
        $sales_table = displayPurchases($sales, true);
        echo $sales_table;
    }

    //displaySales($sales);

    function displayPurchases($purchases, $sales) {
        $font1 = '"tg-bagh"';
        $font2 = '"tg-rmb8"';
        $fontUsed = "";
        $counter = 0;
        $jsonReader = new RecursiveIteratorIterator(
                new RecursiveArrayIterator(json_decode($purchases, true)), RecursiveIteratorIterator::SELF_FIRST);

        $purchase_id;
        $title;
        $license;
        $date;
        $path;
        $done = false;
        $table_name;
        $pending;
        if ($sales) {
            $table_name = "Sales";
        } else {
            $table_name = "Purchases";
        }
        $table = '<table class="tg">'
                . '<tr>'
                . '<th class="tg-a2cf" colspan="6"><h3>Image License ' . $table_name . ' (by date)</h3></th>'
                . '</tr>'
                . '<tr>'
                . '<td class="tg-3mlp">Preview</td>'
                . '<td class="tg-3mlp">Date selected</td>'
                . '<td class="tg-3mlp">Transaction #</td>'
                . '<td class="tg-3mlp">Title</td>'
                . '<td class="tg-3mlp">License option</td>'
                . '<td class="tg-3mlp">Order Status</td>'
                . '</tr>';


        foreach ($jsonReader as $key => $val) {
            if (!is_array($val)) {
                if ($key == "purchase_id") {
                    $purchase_id = $val;
                } else if ($key == 'title') {
                    $title = $val;
                    //title is last thing in each json result
                    $done = true;
                    //echo "DONE = $done";
                } else if ($key == 'license_type') {
                    $license = $val;
                } else if ($key == 'date') {
                    $date = $val;
                } else if ($key == 'path') {
                    $path = $val;
                }else if($key == 'pending'){
                    if($val == 1){
                        $pending = "Pending";
                    }else{
                        $pending = "Completed";
                    }
                }
            }

            if ($done) {
                if ($counter % 2 == 0) {
                    $fontUsed = $font1;
                } else {
                    $fontUsed = $font2;
                }
                $table .= '<tr>'
                        . '<td class ="tg-yw41"><img src="images_thubnail/_' . $path . '" alt=images_thubnail/_"' . $path . '" style="width:90px;height:90px;"></td>'
                        . '<td class=' . $fontUsed . '>' . $date . '</td>'
                        . '<td class=' . $fontUsed . '>' . $purchase_id . '</td>'
                        . '<td class=' . $fontUsed . '>' . $title . '</td>'
                        . '<td class=' . $fontUsed . '>' . $license . '</td>'
                        . '<td class=' . $fontUsed . '>' . $pending . '</td>'
                        . '</tr>';

                $counter++;
                $done = false;
            }
        }
        $table .= '</table>';
        return $table;
    }

    function displaySales($sales) {
        echo '<script type="text/javascript">'
        . 'var table = createSalesTable(\'' . $sales . '\');'
        . '$("#sales").html(table);'
        . '</script>';
    }
    ?>

</body>
</html>