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
  script.js
  jquery
  */
  //Includes, Session Start, and $pdo connect
  include "includes/library.php";
  session_start();
  $pdo = connectdb();

  //if the email has been chosen to reset do:
  if(isset($_POST['email']))
  {
    //if we haven't made a code yet, create the code and email it to the recipient
    if(!isset($_SESSION['code']))
    {
      $random = uniqid();
      $_SESSION['code'] =  $random;
      require_once "Mail.php";  //this includes the pear SMTP mail library
      //Write up the variables for the email
      $from = "Password Reset <noreply@loki.trentu.ca>";
      $to = $_POST['email'];  //put user's email here
      $subject = "Resetting Password";
      $body = "Your password reset number is: $random";
      $host = "smtp.trentu.ca";
      //set the headers
      $headers = array ('From' => $from,
      'To' => $to,
      'Subject' => $subject);
      $smtp = Mail::factory('smtp',
      array ('host' => $host));
      //set the mail to create the email
      $mail = $smtp->send($to, $headers, $body);
      //output error if error
      if (PEAR::isError($mail))
      {
        echo("<p>" . $mail->getMessage() . "</p>");
      }
      //else tell them message successfully sent
    else
      {
      echo("<p>Message successfully sent!</p>");
      }
   }

   //if the user has entered a code then check if its equal to the right code
   else if(isset($_POST['code']))
    {
        //if it is equal to the right code
        if($_SESSION['code']==$_POST['code'])
        {
          //check the passwords are equal, hash one, set passerror to errors if password has errors
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
          //update the bcwBooks_users table with the new password where the email was
          if(!isset($passerror)){
            $sql = "update bcwBooks_users set password = ? where username_email = ?";
            $statement = $pdo -> prepare($sql);
            $statement->execute([$hashpsw,$email]);
            //redirect to the login page
            header("Location:login.php");
            exit();
          }
        }
    }
   }
  ?>
<!DOCTYPE html>
<html lang="en">
  <!-- head of the project with title, links, includes -->
  <head>
    <title>Password Reset</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  </head>
 <!-- all content on the page -->
  <body>
    <!-- head at top of screen -->
    <header>
      <h1>Password Reset</h1>
      <a href="index.php" id="homeButton">Home</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <!-- main content on the page -->
    <main>
    <?php
    //if the email hasn't been chosen yet display the ask for email
      if(!isset($_POST['email'])):
      ?>
      <!-- form for getting username/email to reset-->
      <form id="pswreset" action="passwordreset.php" method="POST">
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            class = "required"
            placeholder="john@smith.com"
          />
        </div>
        <input type="submit" name="forgotpassword" value="Change Password"/>
      </form>
      <!-- if the email has been chosen, display form to get code, email and new password -->
    <?php else:?>
      <form id="pswreset" action="passwordreset.php" method="POST">
        <div>
          <label for="code">Code:</label>
          <input type="text" name="code" id="code" placeholder="A23ri9F" class= "required" required/>
        </div>
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="john@smith.com"
            class = "required"
            required
          />
        </div>
        <div>
          <label for="password">Password:</label>
          <input
            type="password"
            name="password"
            id="password"
            class = "required"
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
            class = "required"
            placeholder="************"
            required
          />
        </div>
        <div id="resetPassword"><input type="submit" name="forgotpassword" value="Change Password"/></div>
      </form>
    <?php endif;?>
    </main>
    <!-- jquery include -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- fallback for jQuery if CDN is unavailable -->
    <script>window.jQuery ||document.write('<script src="scripts/jquery.js"><\/script>');</script>

    <!-- Script.js include -->
    <script src="scripts/script.js"></script>
  </body>
</html>
