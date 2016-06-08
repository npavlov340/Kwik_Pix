<!--
    File Name: display_image.php
    Date: Apr 1 2016
    Description: This file is called by search_request.php.
                 Displays the detail information of an image such as
                 an artist name, an image title, and its description.
-->

<html>
    <head>
        <Title>Display Media</Title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/display_image.css" />
        <link rel="stylesheet" type="text/css" href="css/popup.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        <link rel="stylesheet" type="text/css" href="css/photoinfo.css" />
        <link type="text/css" rel="stylesheet" href="jQuery/jquery-ui.min.css" />
        <link href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="jQuery/jquery-2.2.1.min.js"></script>
        <script type="text/javascript" src="jQuery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="jQuery/search_request.js"></script>
    </head>
    <body>
        <?php
        include_once("navigation.php");
        include "controllers/media_controller.php";
        ?>
        <div id="response">
            <table class="tg" >
                <tr> <th class="tg-i0og" colspan="2"><h3>Image Information</h3></th> </tr>
                <tr>
                    <td class="tg-031e">
                        <div id="column-content">
                            <?php
                                $imageTitle = $_GET["image_title"];
                                echo '<img src="images_thubnail/_' . $imageTitle . '" id="image-detail"></br>';
                            ?>
                        </div>
                    </td>

                    <td class="tg-031e" >
                        <div align="left">
                            <div>
                                <?php
                                $controller = new MediaController($_GET);
                                $result = $controller->show();
                                $media_id; $unlimited_price; $web_price; $print_price;

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<p><strong>Title:</strong> ' . $row["title"] . '</p>';
                                        echo '<p><strong>Artist:</strong> ' . $row["username"] . '</p>';
                                        echo '<p><strong>ID:</strong> ' . $row["media_id"] . '</p>';
                                        echo '<p><strong>Size:</strong> ' . $row["original_width"] . 'x' . $row["original_height"] . '</p>';
                                        echo '<p><strong>Description:</strong> ' . $row["description"] . '</p>';
                                        $unlimited_price = $row["unlimited_price"];
                                        $web_price = $row["web_price"];
                                        $print_price = $row["print_price"];
                                        $media_id = $row["media_id"];
                                    } 
                                }
                                $result->free();
                                ?>

                                <strong>Choose a license plan: </strong>
                                <div class="radio" align="left">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="print" checked>
                                        <strong>Print Use License: $<?php echo $print_price ?></strong>
                                        <p>
                                            Image is to be used in print publication only, one time use.
                                            The related publication may reprint the image in the initial publication up to three reprints,
                                            not to exceed 5 years. Image may not be used on a publication full cover or in packaging.
                                        </p>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="web">
                                        <strong>Web Use License: $<?php echo $web_price ?></strong>
                                        <p>
                                            Image may be used in print, online or in packaging for up to 3 instances.
                                            Related publications or packaging may reprint the image up to 10 times,
                                            not to exceed 10 years. Websites may use the image once in any given domain web site, for up to 5 years.
                                        </p>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios3" value="unlimited">
                                        <strong>Unlimited Use License: $<?php echo $unlimited_price ?></strong>
                                        <p>Image may be used on any media, for an indefinite time period, for indefinite instances.
                                            License does not release copyright or allow resale of the image.</p>
                                    </label>
                                </div>
                                <p>By clicking the buy button, you agree to the <a href="terms.php">Terms and Conditions</a>.</p>
                                <button onclick="showPurchaseWithLicenseDialog(<?php echo $media_id ?>)" type="submit" class="btn btn-primary">Buy</button>
                                <br /><br /><a href="url2">Contact Us</a>
                            </div>
                        </div>

                        <?php include "popup.php"; ?>
                        </span>
                    </td>
                </tr>
            </table>
    </body>
    <?php include_once("footer.html") ?>
</html>
