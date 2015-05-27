<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>

</head>
<body>

   <?php

  echo "
<button id=button>Send an HTTP POST request to a page and get the result back</button>
  <script>
 
$(document).ready(function(){
  $('#button').click(function(){
    $.post('test1.php',
    {
      name:'Donald Duck',
      city:'Duckburg'
    },
    function(data,status){
      alert('Data: ' + data + 'Status:  '+ status);
    });
  });
});
</script>
<script>
$(document).ready(function(){
  $('#button1').click(function(){
    $.post('test1.php',
    {
      name:'Donald Duck',
      city:'Duckburg'
    },
    function(data,status){
      alert('Data: ' + data + 'Status: ' + status);
    });
  });
});
</script>


<button id=button1>Send an HTTP POST request to a page and get the result back</button>";?>

</body>
</html>
