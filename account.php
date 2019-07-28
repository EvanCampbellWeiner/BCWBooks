<?php
/*  Page Name: account.php
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  Allows the user to view the details of their account (username) and edit it if they would like.


  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
  jquery
  script.js
  fontawesome
*/
//includes, session start, connect to database
include "includes/library.php";
session_start();
$pdo = connectdb();

  //Redirect if not logged in
  if(!isset($_SESSION['user']))
  {
    header("Location:login.php");
    exit();
  }
  //Otherwise set the email to the user session
  //$email = $_SESSION['user'];
  $sessionEmail = filter_var($_SESSION['user'], FILTER_SANITIZE_EMAIL);
  $sessionEmail = filter_var($_SESSION['user'], FILTER_VALIDATE_EMAIL);

  //If they clicked the update book button
  if(isset($_POST['update']))
  {
    //if the email is not empty
    if($email!="")
    {
      //set email to the post array
      $email = $_POST['email'];
      //set password to post array
      $psw = $_POST['password'];
      //Santize email
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      //Validate email
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      //Find all of the information from the database on the email
      $sql = "select * from bcwBooks_users where username_email =?";
      $statement = $pdo -> prepare($sql);
      $statement -> execute($sessionEmail);
      //Set data to result
      $result = $statement->fetch();

      //If something is returned
      if($result)
      {
        //if the passwords match up
        if (password_verify($psw, $result['password']))
          {
            //if the password needs rehashing, rehash it and send to database
            if (password_needs_rehash($result['password'], PASSWORD_DEFAULT, $options))
            {
              $newHash = password_hash($psw, PASSWORD_DEFAULT, $options);
              $sql = "update bcwBooks_users set password= ? where id =?";
              $statement = $pdo -> prepare($sql);
              $statement -> execute([$newHash, $result['id']]);
            }

            //Update the databases email
            $sql = "update bcwBooks_users set username_email= ? where id =?";
            $statement = $pdo -> prepare($sql);
            $statement -> execute([$email, $result['id']]);
            $_SESSION['user'] = $email;

            //reload the account page
            header("Location: account.php");
            exit();
          }
          //If password doesn't match, set passerror to an error message
        else
          {
             $passerror = "Error: Invalid Email or Password";
          }
      }
      //If username doesn't match, set passerror to an error message
      else
      {
        $passerror = "Error: Invalid Email or Password";
      }
    }
  }

?>
<!-- HTML for the page -->
<!DOCTYPE html>
<html lang="en">

<!-- Head portion with links to css -->
  <head>
    <title>Account</title>
    <!-- Link to reset .css -->
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- Link to style.css-->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
<!-- body of the page -->
  <body>
    <!-- Header portion -->
    <header>
      <h1>Account</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>
      <?php
      if(isset($_SESSION['user'])): //if the user has been set show logout
      ?>
      <a href="logout.php" id="loginButton">Logout</a>
    <?php else: // if the user hasn't been set show login?>
      <a href="login.php" id="loginButton">Login</a>
      <?php endif; ?>
    </header>
    <!-- Main portion of the page -->
    <main>
      <!-- Form for updating account -->
      <form id="updateAccount" action="account.php" method="post">
      <!-- Header for change email form -->
        <h3>Change Email</h2>
        <!-- Div to show the Current Email -->
        <div>Previous Email:<?php echo $email ?></div>
        <!-- Div to type in new email -->
        <div>
          <label for="email">New Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            value = <?php echo $email ?>
            class = "required"
            required/>
        </div>
        <!-- Div to enter current password -->
        <div>
          <label for="password">Enter Password:</label>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="*************"
            class = "required"
            required
          />
        </div>
        <!-- Button to update email -->
        <button type="submit" name="update" id = "resetEmail">Update Email</button>
        <!-- link to reset password page -->
        <a href="passwordreset.php" >Forgot password?</a>
      </form>
    </main>
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <!-- Script for jQuery
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- fallback for jQuery if CDN is unavailable -->
    <script>
      window.jQuery ||
        document.write('<script src="scripts/jquery.js"><\/script>');
    </script>
    <!-- Script to get to script.js-->
    <script src="scripts/script.js"></script>
  </body>
</html>
