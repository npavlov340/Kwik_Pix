<?php
    include_once "controllers/purchase_orders_controller.php";
    include_once "controllers/sessions_controller.php";
    $sessions = new SessionsController($_COOKIE);
    
    $text = "";
    if($sessions->activeCookie()){
        $text = "Thank you for your purchase. A Quick Pix representative will contact you shortly!";
    } else {
        $text = "Please call 1-800-kwikpix to speak with a customer care expert.";
    }
?>
<!--dialog box-->
<div id="white-background"></div>
<div id = "dlgbox">
    <div id="dlg-header">Thank you for your interest in in Kwik-Pix media!</div>
    <div id="dlg-body"><?php echo $text ?></div>
    <div id="dlg-footer">
    <button type="submit" class="btn btn-primary" onclick="closeDialog()">Close</button>
    </div>
</div>

<!-- dialogbox script -->
<script>
function showDialog(){
    var whitebg = document.getElementById("white-background");
    var dlg = document.getElementById("dlgbox");
    whitebg.style.display = "block";
    dlg.style.display = "block";

    var winWidth = window.innerWidth;
    var winHeight = window.innerHeight;

    dlg.style.left = (winWidth/2) - 480/2 + "px";
    dlg.style.top = "150px";
}

function closeDialog() {
    var whitebg = document.getElementById("white-background");
    var dlg = document.getElementById("dlgbox");
    whitebg.style.display = "none";
    dlg.style.display = "none";
    
    
//window.location.href = "account.php";
}

function showPurchaseWithLicenseDialog(mediaId){
    var licenseType = $("input[name='optionsRadios']:checked").val();
    debugger;
    purchase(mediaId, licenseType);
    showDialog();
}

function showPurchaseDialog(mediaId){
    purchaseDefault(mediaId);
    showDialog();
}

function purchase(mediaId, licenseType){
    $.ajax({
            type: 'POST',
            url: './purchase.php',
            data: { media_id: mediaId, license_type: licenseType },
            success: function() { console.log('Susscefully purchased' + mediaId ); }
        });
}

function purchaseDefault(mediaId){
    $.ajax({
            type: 'POST',
            url: './purchase.php',
            data: { media_id: mediaId, license_type: 'print' },
            success: function() { console.log('Susscefully purchased' + mediaId ); }
        });
}


</script>
