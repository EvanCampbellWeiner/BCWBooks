<?php
  include 'includes/library.php';
  $pdo =  connectdb();

  $email = $_GET['email'];

  $sql = "select username_email from bcwBooks_users where username_email = ?";
  $check = $pdo->prepare($sql);
  $check->execute([$email]);


  if($check->fetchColumn()){
    echo "true";
  }
  else
  {
    echo "false";
  }


?>
