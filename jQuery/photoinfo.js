/*
 File Name: photoinfo.js
 Description: This file handles the popup windows for the Photo Information page
 when the buy button is clicked.  
 */

$(document).ready(function() {
    var license;
    var button_id = '#buy-button';    
    
    $(button_id).click(function(event) {
        // Determines which radio button is selected, and places
        // approriate string in license variable, which is used 
        // for the dialog box message.
        if ($('#optionsRadios1').prop('checked')){
            license = "Limited Use License";
        } else if ($('#optionsRadios2').prop('checked')){
            license = "Extended Use License";
        } else if ($('#optionsRadios3').prop('checked')){
            license = "Unlimited Use License";
        }       
        
    });
});

