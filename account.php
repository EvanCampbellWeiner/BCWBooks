<?php
/*  Page Name: account.php
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  Allows the user to upload the details for a book including a cover and copies of the books
  in relative formats.


  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
*/
include "includes/library.php";
  session_start(); //start session
  $pdo = connectdb();

  //check session for user info
  if(!isset($_SESSION['user'])){
    //no user info, redirect
    header("Location:login.php");
    exit();
  }
  $email = $_SESSION['user'];
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  //After sanitization Validation is performed
  $email = filter_var($email, FILTER_VALIDATE_EMAIL);

  if(isset($_POST['update']))
  {
    if($email!="")
    {
      $email = $_POST['email'];
      $psw = $_POST['password'];

      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      //After sanitization Validation is performed
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      $sql = "select * from bcwBooks_users where username_email =?";
      $statement = $pdo -> prepare($sql);
      $statement -> execute([$_SESSION['user']]);
      $result = $statement->fetch();
      //get data from post
      //Select data from database based on username
      //fetch row from result set - make sure to check that something was returned
      if($result)
      {
        if (password_verify($psw, $result['password']))
          {
            if (password_needs_rehash($result['password'], PASSWORD_DEFAULT, $options))
            {
              $newHash = password_hash($psw, PASSWORD_DEFAULT, $options);
              //update database with new hash
            }

            $sql = "update bcwBooks_users set username_email= ? where id =?";
            $statement = $pdo -> prepare($sql);
            $statement -> execute([$email, $result['id']]);
            $_SESSION['user'] = $email;

            header("Location: account.php");
            exit();
          }
        else
          {
             $passerror = "Error: Invalid Email or Password";
          }
      }
      else
      {
        $passerror = "Error: Invalid Email or Password";
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- fallback for jQuery if CDN is unavailable -->
    <script>
      window.jQuery ||
        document.write('<script src="scripts/jquery.js"><\/script>');
    </script>

    <!-- Example - Relative Path - -->
    <script src="scripts/script.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <header class="fullHeader">
      <h1>Account</h1>

      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>
      <?php
      if(isset($_SESSION['user'])):
      ?>
      <a href="logout.php" id="loginButton">Logout</a>
      <?php else:?>
      <a href="login.php" id="loginButton">Login</a>
      <?php endif; ?>
    </header>
    <main>
      <form id="updateAccount" action="account.php" method="post">
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
              value = <?php echo $email ?>
          />
        </div>
        <div>
          <label for="password">Password:</label>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="*************"
            required
          />
        </div>
        <button type="submit" name="update">Update Email</button>
        <a href="passwordreset.php" >Forgot password?</a>
      </form>
    </main>
  </body>
</html>
