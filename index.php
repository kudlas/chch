<?php
 session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <link rel="stylesheet" href="style.css" type="text/css">
  <title></title>
  </head>
  <body>

  <?php

  include_once 'login.php';    
          
  ?>

  <div id="bar">
   
   <div class="post">
      <strong>System:</strong>
      <span class="content">ahoj</span>
      
    <hr>
   </div>
   
  </div>
  
  <ul id="onlines">
     <img src="http://calculators.infochoice.com.au/Content/Images/ajax-loader.gif">
  </ul>
  
  <form method="post"><label for="message">m</label>
    <input class="message" type="text">
    <button class="odeslat">odeslat</button>
  </form>
  
  

  
  <script src="jquery-1.11.0.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="chat.js" ></script>
  
  </body>
</html>