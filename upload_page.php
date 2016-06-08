

<html> 
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/upload.css">   
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> 
        <link rel="stylesheet" type="text/css" href="css/search.css">   
    </head>    

    <!-- Include Search Bar -->
    <?php include_once("navigation.php") ?>  
    <body>
        
        <div>
            <form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
                <h1> Upload an image with a Title and Description</h1>
                <div class="input-group"><label for="title">Title: </label><input type="text" name="title" id="title" required="required"></div>
                <div class="input-group"><input type="file" name="fileToUpload" id="fileToUpload" required="required"></div>
                <div class="input-group"><label for="description">Description: </label><input type="text" name="description" id="description" required="required"></div>
                <div class="input-group"><label for="keywords"> Enter Keywords: </label><input type="text" name="keywords" id="keyword" required="required"></div>
                <div class="input-group">
                    <label for="unlimited">Enter Unlimited price ($): </label>
                    <input type="number" value="1000" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="currency" name="unlimited" id="unlimited" required="required"/>
                </div>
                <div class="input-group">
                    <label for="web">Enter Web price ($): </label>
                    <input type="number" value="1000" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="currency" name="web" id="web" required="required"/>
                </div>
                <div class="input-group">
                    <label for="print">Enter Print price ($): </label>
                    <input type="number" value="1000" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="currency" name="print" wwwwwwid="print" required="required"/>
                </div>
                <div class="input-group"><input type="submit" value="Upload Image" name="submit"></div>
            </form>
        </div>
    </body>
</html>
