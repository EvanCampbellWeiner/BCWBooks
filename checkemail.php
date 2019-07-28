<?php
/*
Page Name: checkemail.php
Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
Language: HTML5 and PHP
Page Description:
backend page that returns whether or not the email exists in the database

*/

  //Includes, connect to database
  include 'includes/library.php';
  $pdo =  connectdb();
  //get the email from the get array
  $email = $_GET['email'];
  //if the email is found, return true
  $sql = "select username_email from bcwBooks_users where username_email = ?";
  $check = $pdo->prepare($sql);
  $check->execute([$email]);
  if($check->fetchColumn()){
    echo "true";
  }
  //else return false
  else
  {
    echo "false";
  }
?>
