<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <link type="text/css" rel="stylesheet" href="jQuery//jquery-ui.min.css" />
        <link href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="jQuery/jquery-2.2.1.min.js"></script>
        <script type="text/javascript" src="jQuery/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/search.css" />
        <link type="text/css" rel="stylesheet" href="jQuery/jquery-ui.min.css" />

    </head>    

    <!-- Include Search Bar -->
    <?php include_once("navigation.php") ?>     

    <!-- Create the login form, get user data and compare with Database-->    
    <body>     
        <div class="login">
            <h2>Login</h2>
            <fieldset id="info" class="field">
                <form action="check_user.php" method="get" enctype="multipart/form-data"> 
                    <div class="input-group" id="user">
                        <label for="user">Username</label>
                        <input name="Username"/>
                    </div>
                    <div class="input-group" id="pass">
                        <label for="pass">Password</label>
                        <input name="Password" type="password">
                    </div>
                    <div class="input-group" id="login">
                        <input class="btn btn-primary" type="submit" value="Login" name="submit">                
                    </div>
                </form>
            </fieldset>   
        </div>
        <div class="signup">
            <h2>Create an account</h2>
            <fieldset id="info" class="field">
                <form action="check_signup_db.php" method="post" enctype="multipart/form-data"> 
                    <div class="input-group" id="fname">
                        <label for="fname">First Name</label>
                        <input name="fname"/>
                    </div>
                    <div class="input-group" id="lname">
                        <label for="lname">Last Name</label>
                        <input name="lname"/>
                    </div>

                    <div class="input-group" id="email">
                        <label for="email">Email Address</label>
                        <input name="email" type="email">
                    </div>
                    <div class="input-group" id="user">
                        <label for="user">Username</label>
                        <input name="Username"/>
                    </div>

                    <div class="input-group" id="pass">
                        <label for="pass">Password</label>
                        <input name="Password" type="password">
                    </div>
                    <div class="input-group" id="conPass">
                        <label for="conPass">Confirm Password</label>
                        <input name="conPass" type="password">
                    </div>
                    <div class="input-group" id="TOS">
                        <input type="checkbox" name="TOS" value="TOS">I have read and agreed to the 
                        <a href="terms.php">Terms of Service</a><br>
                    </div>
                    <div class="input-group" id="register">
                        <input class="btn btn-primary" type="submit" value="Register" name="submit">                
                    </div>
                    <div class="input-group" id="contact">                    
                        <a href="terms.php">Contact Us</a><br>             
                    </div>
                </form>
            </fieldset>
        </div>
    </body>
    
</html>