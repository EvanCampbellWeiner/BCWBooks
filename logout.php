<?php
  //Page Name: logout.php
  //Programmer Names: Evan Campbell-Weiner and Alan Michael Bradshaw
  //Page Description: destroys a session and leavesw to the homepage
  session_start();
  session_destroy();
  header("Location:index.php");
  exit();
 ?>
