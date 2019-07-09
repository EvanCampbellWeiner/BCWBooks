<?php
  /*
  Page Name: passwordreset.php
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  A password reset page that allows the user to enter an email, sends an emails to the emails
  with a code, which then can be utilized to update the account password.



  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
  */
  include "includes/library.php";
session_start();
$pdo = connectdb();
  if(isset($_POST['email']))
  {
    if(!isset($_SESSION['code'])){
      var_dump($_POST);
    $random = rand(0,100000000);
    $_SESSION['code'] =  $random;
    require_once "Mail.php";  //this includes the pear SMTP mail library
    $from = "Password Reset <noreply@loki.trentu.ca>";
    $to = $_POST['email'];  //put user's email here
    $subject = "Resetting Password";
    $body = "Your password reset number is: $random";
    $host = "smtp.trentu.ca";
    $headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);
    $smtp = Mail::factory('smtp',
      array ('host' => $host));

    $mail = $smtp->send($to, $headers, $body);
    if (PEAR::isError($mail))
      {
      echo("<p>" . $mail->getMessage() . "</p>");
     }
    else
      {
      echo("<p>Message successfully sent!</p>");
     }
   }
   else if(isset($_POST['code']))
    {
      var_dump($_POST);
        if($_SESSION['code']==$_POST['code'])
        {
          $psw = $_POST['password'];
          $psw2 = $_POST['password2'];
          $email = $_POST['email'];
          $options = array('cost' => 12);
          $hashpsw = password_hash($psw, PASSWORD_DEFAULT, $options);
          if(strlen($psw)<8){
            $passerror = "Error: Password must be more then 8 characters";
          }
          else if($psw != $psw2)
          {
            $passerror = "Error: Passwords do not match.";
          }
          //get data from POST
          //check for errors
          if(!isset($passerror)){
            $sql = "update bcwBooks_users set password = ? where username_email = ?";
            $statement = $pdo -> prepare($sql);
            $statement->execute([$hashpsw,$email]);
            //redirect elsewhere
            header("Location:login.php");
            exit();
          }
        }
    }
   }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <header class="fullHeader">
      <h1>Password Reset</h1>
      <a href="index.php" id="homeButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <main>
    <?php
      if(!isset($_POST['email'])):
      ?>
      <form id="pswreset" action="passwordreset.php" method="POST">
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="john@smith.com"
          />
        </div>
        <input type="submit" name="forgotpassword" value="Change Password"/>
      </form>
    <?php else:?>
      <form id="pswreset" action="passwordreset.php" method="POST">
        <div>
          <label for="code">Code:</label>
          <input type="text" name="code" id="code" placeholder="A23ri9F" />
        </div>
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="john@smith.com"
          />
        </div>
        <div>
          <label for="password">Password:</label>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="************"
            required
          />
        </div>
        <div>
          <label for="password2">Re-type Password:</label>
          <input
            type="password"
            name="password2"
            id="password2"
            placeholder="************"
            required
          />
        </div>
        <input type="submit" name="forgotpassword" value="Change Password"/>
      </form>
    <?php endif;?>
    </main>
  </body>
</html>
