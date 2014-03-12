<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  </head>
  <body>

    <?php
     
     //$_SESSION["ahoj"] = time() + 30;
     
    $now30 = time() + 1 * 30;
    $now = time();
    
    
    echo "ted je: ".date("h:i:s", $now);
    
    echo "<br>za 30 vteřin bude : ".date("h:i:s", $now30);
    
    echo "<br>v session je: ".date("h:i:s", $_SESSION["ahoj"]);   
    
    echo "<br>je session menší než teď? ".($_SESSION["ahoj"]<time());  
    ?>

  </body>
</html>
