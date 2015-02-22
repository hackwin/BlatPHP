<?php
  
  require_once("email.php");
  echo "<form method='POST'><input type='submit' name='sendEmail' value='Send Email'></form>";
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      
      $result = email::send($to="jcamp"."@"."gmx"."."."com",$subject="PHP wrapper for Blat",$body="If you get this, please reply that it works!");
      
      echo "<h2>Result</h2>";
      
      if ($result["return_var"] == 0)  //zero if all is well
        echo "<span style='background-color: lightgreen'>sent</span>";
      else{
        echo "<span style='background-color: pink'>didn't send</span>";
        echo "<pre>".print_r($result,true)."</pre>";
      }
  }
  
?>
