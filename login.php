<?php

$db_tables = array("user" => "user","nick" => "NICK","pass" => "PASS");
$return = "";
$end = "</body> </html>";
$login_form = '<form method="post">
                <input type="text" name="login" placeholder="Nck">
                <input type="password" name="pass" placeholder="pswd">
                <input type="submit" value="submit voe">
               </form>';



  if(!isset($_SESSION['userId']) )
  {
    $return .= $login_form;

    if (isset($_POST["login"],$_POST["pass"])) {
    // log in
    include 'db.php';
    
    $pass = sha1( "sůlVočích" . md5( $db->real_escape_string($_POST["pass"]) ) );
    $login = $db->real_escape_string($_POST["login"]);  

    $result = $db->query('SELECT * FROM `'.$db_tables["user"].'` WHERE '.$db_tables["nick"].' = "'.$login.'" AND '.$db_tables["pass"].' = "'.$pass.'"');
   
     if ($result->num_rows==0) {
       
      die("heslo blbě");      
     }
     else
     {
     $row = $result->fetch_assoc();
       
     $db->query("INSERT INTO `test`.`messages` ( `MESSAGE`, `WHO`, `WHEN`) VALUES ( '".$row["NICK"]." právě přišel', '1', NOW() );");  
       
       $_SESSION['userId'] = $row["ID"]; // change later
       $_SESSION['timeout']= time();
     }
        
     
     
    
    }
    else    
    die($return.$end);

  }