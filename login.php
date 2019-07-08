<?php
  /*
  Page Name: login.html
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  A login page that allows a user to enter their username and Password
  as well as a remember me link.



  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
  bcwBooks_users
  */
  include "includes/library.php";
  session_start();
  $pdo = connectdb();
//Needs validation
  if(isset($_POST['submit']))
    {
      //get data from post
      //Select data from database based on username
      //fetch row from result set - make sure to check that something was returned
      if (password_verify($pass, $row['pass'])) {
        if (password_needs_rehash($row['pass'], PASSWORD_DEFAULT, $options))
        {
          $newHash = password_hash($pass, PASSWORD_DEFAULT, $options);
          //update database with new hash
        }
        //redirect to main page
        }
        else
         {
           $error=true;
         }
      //hash password
      //check if username / password is in database.
      //if it is, set session variables to it.
      //then redirect to library.
      //if it is not, then add to error and display element
      //sanitizing email
      $_POST['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $email = $_POST['email'];
      $psw = $_POST['password'];
      $sql = "select * from bcwBooks_users where username_email =?";
      $statement = $pdo -> prepare($sql);
      $statement -> execute([$email, $psw]);
      $result = $statement->fetch();
      if($result && password_verify($psw, $result['password'])) {
        $_SESSION['user'] = $_POST['user'];
      }
      else{
        $errors = "Incorrect Password";
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
      <h1>Login</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <main>
      <form id="login" action="login.php" method="post">
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="john@smith.com"
            required
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
        <input type="submit" name="submit" value="Login"/>
        <?php
          if(isset($errors)):
            ?>
          <span class="errors"> <?php  echo $errors; ?> </span>
     <?php endif; ?>
      </form>
      <a href="passwordreset.php" >Forgot password?</a>
    </main>
  </body>
</html>
