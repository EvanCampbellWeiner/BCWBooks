<?php
  /*
  Page Name: login.html
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  A login page that allows a user to enter their username and Password
  as well as reset password and remember me functionality



  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
  bcwBooks_users
  */
  include "includes/library.php";
  session_start();
  $pdo = connectdb();
//If they submitted the form
  if(isset($_POST['submit']))
    {
      //set the email and password variables
      $email = $_POST['email'];
      $psw = $_POST['password'];
      //Sanitize/Validate the email
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $email = filter_var($email, FILTER_VALIDATE_EMAIL);

      //if the email isn't empty
      if($email!="")
      {
        //find the row the email pertains too
        $sql = "select * from bcwBooks_users where username_email =?";
        $statement = $pdo -> prepare($sql);
        $statement -> execute([$email]);
        $result = $statement->fetch();

        //if the database returns a result
        if($result)
        {
            //if the password is verified
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
              //set the session up to use the user chosen
              $_SESSION['user'] = $result['username_email'];
              //if they chose the remember me function, set the cookie up to last 14 days
              if($_POST['remember'])
              setcookie("BCWBooksUsername", $_SESSION['user'],time()+60*60*24*14);
              //go to the bookshelf logged in
              header("Location: bookShelf.php");
              exit();
            }
            //if there is a password error set passerror to error
            else
            {
               $passerror = "Error: Invalid Email or Password";
            }
        }
        //if there is a username error set passerror to error
        else
        {
          $passerror = "Error: Invalid Email or Password";
        }
      }
    }
  ?>
<!DOCTYPE html>
<!-- html part -->
<html lang="en">
<!-- head of the document -->
  <head>
    <title>Login</title>
    <!-- style sheet links -->
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
<!-- main body of documnet -->
  <body>
    <!-- head of the document -->
    <header>
      <h1>Login</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <!-- main part of body -->
    <main>
      <!-- the login form -->
      <form id="login" action="login.php" method="post">
        <!-- if there is an error show it -->
        <?php if(isset($passerror)):?>
          <div><?php echo $passerror;?></div>
        <?php endif;?>
        <!-- input for email -->
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            class = "required"
            <?php
            if(isset($_COOKIE['BCWBooksUsername'])): //if cookie is set, set its value to the cookies value
              ?>
              value = <?php echo $_COOKIE['BCWBooksUsername'] ?>
            <?php else://if not set placeholder ?>
            placeholder="john@smith.com"
          <?php endif;?>
            required
          />
        </div>
        <!-- input for password -->
        <div>
          <label for="password">Password:</label>
          <input
          class = "required"
            type="password"
            name="password"
            id="password"
            placeholder="************"
            required/>
        </div>
        <!-- Remember me checkbox -->
        <div>
          <label for = "remember">Remember Me:</label>
          <input type= "checkbox" name = "remember" id = "remember"/>
        </div>
        <!-- submit button -->
        <input type="submit" name="submit" value="Login" id = "submit"/>
        <!-- forgot password link -->
        <a href="passwordreset.php" >Forgot password?</a>
      </form>
    </main>
    <!-- include scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- fallback for jQuery if CDN is unavailable -->
    <script>
      window.jQuery ||
        document.write('<script src="scripts/jquery.js"><\/script>');
    </script>

    <!-- script.js include - -->
    <script src="scripts/script.js"></script>
  </body>
</html>
