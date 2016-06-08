<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" type="text/css" href="css/sign_up.css">   
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link type="text/css" rel="stylesheet" href="jQuery//jquery-ui.min.css" />
        <link href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="jQuery/jquery-2.2.1.min.js"></script>
        <script type="text/javascript" src="jQuery/jquery-ui.min.js"></script>
    </head>

    <!-- Include Search Bar -->
    <?php include_once("navigation.php") ?>    	

    <!-- Create the sign up form, get user data to put into Database-->
    <body>
        <fieldset id="info" class="field">
            <form action="check_signup_db.php" method="post" enctype="multipart/form-data"> 
                <div id="fname">
                    <label for="fname">First Name</label>
                    <input name="fname"/>
                </div>
                <div id="lname">
                    <label for="lname">Last Name</label>
                    <input name="lname"/>
                </div>

                <div id="email">
                    <label for="email">Email Address</label>
                    <input name="email"/>
                </div>
                <div id="user">
                    <label for="user">Username</label>
                    <input name="Username"/>
                </div>

                <div id="pass">
                    <label for="pass">Password</label>
                    <input name="Password"/>
                </div>
                <div id="conPass">
                    <label for="conPass">Confirm Password</label>
                    <input name="conPass"/>
                </div>
                <div id="TOS">
                    <input type="checkbox" name="TOS" value="TOS">I have read and agreed to the 
                    <a href="terms.php">Terms of Service</a><br>
                </div>
                <div id="register">
                    <input type="submit" value="Register" name="submit">                
                </div>
                <div id="contact">                    
                    <a href="terms.php">Contact Us</a><br>                
                </div>
            </form>
        </fieldset>
    </body>
</html>