/*
 Date: Created on Mar 15 2016
 File Name: search_request.js
 Description: M2 in CSC648
              Demo js file for jQuery, jQuery UI, and Ajax.
              This script sends a request(search term) to the server

              Description: Edited on May 5 2016
              Script file for Kwik-Pix website that handles creating
              the image table.
 References:
 http://www.ajax-tutor.com/140/send-request-server/
 http://www.w3schools.com/ajax/ajax_xmlhttprequest_send.asp
 */

// jQuery
$(document).ready(function() {
    var server_url = './search_images.php';
    var result_url = './search_result.php';
    var button_id = '#search-button'; 
    var text_id = '#search-term';
    var landing_button_id = '#landing-search-button'; 
    var landing_text_id = '#landing-search-term';
    var response_div = '#response';
    var table;
    var num_columns = 3; // Number of columns of the image table
    // jQuery UI
    // Add a search icon to the search button
    $(button_id).button({
     	icons: { secondary: 'ui-icon-search' }
    });
            
    // AJAX
    // Retrieve the user's search term from a html file and
    // send it to the server(/controllers/pictures.php)
    $(button_id + ', ' + landing_button_id).click(function(event) {
        console.log("clicked");
        var search_term = ( $(text_id).val() === "") ? 
            $(landing_text_id).val() : search_term = $(text_id).val();
        
        if( search_term <= 1 ) { return; }
        else {
            event.preventDefault();
            $.ajax({
                type: 'GET',
                url: server_url,
                data: { keywords: search_term },
                success: function(data) {
                    window.location.href=result_url + "?search=" + 
                    search_term + "&table=" + createImageTable(data, num_columns);              
                },
                error: function() {
                     console.log("Datebase Error");
                }
            });
        }
    });
   

    $("#right-arrow").click(function(event) {
        var lastId = $(".result-image").last().data('id');
        event.preventDefault();

        $.ajax({
            type: 'GET',
            url: './page.php',
            data: { last_id: lastId },
            success: function(data) {
                $(response_div).html(createImageTable(data, num_columns));
            }
        });
    });

    $("#left-arrow").click(function(event) {
        var firstId = $(".result-image").first().data('id');
        event.preventDefault();

        $.ajax({
            type: 'GET',
            url: './page.php',
            data: { previous_id: firstId },
            success: function(data) {
                $(response_div).html(createImageTable(data, num_columns));
            }
        });
    });
});


// Returns a string that represents as <table> tab in html
// Value: data - data returned from controller/pictures.php
//      : numColums - how many columns your table to have
function createImageTable(data, numColumns){
    var JSONdata = JSON.parse(data);
    var table = '<table align="center"><tr>\n';
    var i = 0;
    JSONdata.forEach(function(item) {
      table += '<td class="result-cell"><div class="result-image-container">';
      table += '<a class="image-link" href="display_image.php?image_title=' + item.url + '">';
      table += '<img data-id="' + item.id + '" class="result-image zoom"';
      table += 'src="/~s16g05/images_thubnail/_' + item.url  + '"  data-zoom-image="uploads/' + item.url + '" >';
      table += '</a>';
      table += '<div class="image-title">' + item.title + '</div>';
      table += '<button onclick="showPurchaseDialog('+ item.id +')" type="submit" class="btn btn-primary">Buy</button>';
      table += '</td>';
      i++;
      if(i % numColumns === 0) { table += '</tr><tr>\n'; }
    });

    table += '</table>';
    return table;
}
