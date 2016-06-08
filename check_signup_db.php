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
<fieldset id="info" class="field">
    <?php
        $username = $_POST["Username"];
        $password = $_POST["Password"];
        $email = $_POST["email"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $cpassword = $_POST["conPass"];
        $fields = array('fname', 'lname', 'email', 'Username', 'Password', 'conPass');


        foreach($fields AS $fieldname) { 
            if(empty($_POST[$fieldname])) {
            echo '<div id="checkText"> Field '.$fieldname.' missing!<br /> </div>';  
            }   
        }

        if($password!=$cpassword)
        {
            header("Refresh: 3; login.php"); 
            echo '<div id="checkText">
                        Passwords do not match <br /><br />
                        Redirecting Page...
                        </div>'; 
            exit;
        }

        else if (!isset($_POST['TOS']))
        {
            header("Refresh: 3; login.php"); 
            echo '<div id="checkText">
                    Please confirm Terms of Service checkbox<br />
                    Redirecting Page...
                    </div>';
            exit; 
        }

        else {

            $db = DataBase::get_instance(DataBase::$default_config);
            $sql = "INSERT INTO users
            VALUES (DEFAULT, '$email', '$username', '$password', 'artist', '$fname','$lname','1')";
            $result = $db->transaction($sql);
            header("Refresh: 3; landing.php"); 
            echo '<div id="checkText">
                    Successfuly Registered<br /><br />
                    Redirecting Page...
                    </div>';
        }
    ?>
</fieldset>
</html>
