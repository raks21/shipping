<!doctype html>
<html>
 <head>
   <title>How to Autocomplete textbox in CodeIgniter with jQuery UI</title>

   <!-- jQuery UI CSS -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
 </head>
 <body>
 
  Search User : <input type="text" id="autouser">

 
  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
  
     $( "#autouser" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "http://192.168.100.100/shipping_test/issueregister/placeList",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#autouser').val(ui.item.label); // display the selected text
       $('#userid').val(ui.item.value); // save selected id to input
       return false;
      }
     });

  });
  </script>
 </body>
</html>