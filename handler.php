<?php
// obtain
session_start();

if(isset($_SESSION['userId']) ) {       
if(array_key_exists("send", $_POST)) // posting message
{
 include 'db.php';
$message = $db->real_escape_string($_POST["send"]);

$result = $db->query("INSERT INTO `test`.`messages` ( `MESSAGE`, `WHO`, `WHEN`) VALUES ( '".$message."', '".$_SESSION['userId']."', NOW() );");

       if($result)
       {                 
          $current = file_get_contents("newest");
          $inserted = $db->insert_id;
          
          if($current<$inserted)                     
          file_put_contents("newest",$inserted);
          echo 1;       
       }
       else
       {
          echo 0;                 
       }
}
else
{    

  $userCurrent = $_POST["lastId"];
  $newest = file_get_contents("newest");
  
  
  // when there are new posts
  if($userCurrent<$newest)
  {
     include 'db.php';
     $biggerThan = $db->real_escape_string($userCurrent);
     $q = "SELECT messages.`ID`,NICK,`WHEN`,MESSAGE FROM messages join user on user.ID = WHO WHERE messages.ID > $biggerThan;";
     
     $result = $db->query($q);
     
     
     $return = array(); 
     while ($row = $result->fetch_assoc()) { 
     
        $row["MESSAGE"] = htmlspecialchars($row["MESSAGE"]);
       $return[] = $row;
     }
      
  }
 
}
     // checking if user is online
  
  $minutes = 1;
  
  if ($_SESSION['timeout'] < time() ) {
    include 'db.php';
    $_SESSION['timeout'] = time() + $minutes * 10;    // deset vteřin, změnit 10 na 60 a bude fachat
    $db->query('UPDATE  `test`.`user` SET  `SEEN` =  NOW() WHERE  `user`.`ID` = '.$_SESSION['userId'].';');
    
    $onlines = array();
    $result = $db->query('SELECT NICK from user where SEEN > now() - INTERVAL 2 MINUTE');
    while($row = $result->fetch_array())
    {
      $onlines[] = $row;
    }
    $return["ONLINES"] = $onlines;
  } 
  
  if(!empty($return))
    echo json_encode($return);   
  
  
}