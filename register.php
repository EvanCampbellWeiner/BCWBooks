<?php
/*
  Page Name: register.html
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  Allows the user to register an account, using their email and a password.




  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
  */
  //includes, session start, connect to database
  include "includes/library.php";
  session_start();
  $pdo = connectdb();
  //if they've submitted the form
  if(isset($_POST['submit']))
  {
    //set the passwords to psw1,2 and set email to email
    $psw = $_POST['password'];
    $psw2 = $_POST['password2'];
    $email = $_POST['email'];
    //hash the password
    $options = array('cost' => 12);
    $hashpsw = password_hash($psw, PASSWORD_DEFAULT, $options);
    //find the username in the datbaase
    $sql = "select username_email from bcwBooks_users where username_email = ?";
    $statement = $pdo -> prepare($sql);
    $statement->execute([$email]);
    $result = $statement->fetch();
    //if the password isn't long enough, display an error
    if(strlen($psw)<8){
      $passerror = "Error: Password must be more then 8 characters";
    }
    //if the passwords aren't the same
    else if($psw != $psw2)
    {
      $passerror = "Error: Passwords do not match.";
    }
    //if the email is already in use
    else if($result)
    {
      $passerror = "Error: Email is already in use.";
    }
    //get data from POST
    //check for errors
    if(!isset($passerror)){
      $sql = "insert into bcwBooks_users(username_email, password) values (?,?)";
      $statement = $pdo -> prepare($sql);
      $statement->execute([$email, $hashpsw]);
      //insert into database using parametrized query
      //session stuff
      $_SESSION['user'] = $email;
      //cookie stuff
      //redirect elsewhere
      header("Location:bookShelf.php");
      exit();
    }
  }
?>
<!-- Main html portion -->
<!DOCTYPE html>
<html lang="en">
<!-- head with includes links -->
  <head>
    <title>Register</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css"  />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <!-- Main content of page -->
  <body>
    <!-- head portion of the document -->
    <header>
      <h1>Register</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <!-- main part of document -->
    <main>
      <!-- register form -->
      <form id="register" action="register.php" method="POST">
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            class = "registeremail required"
            placeholder="john@smith.com"
            required
          />
        </div>
        <!-- if there is a password error display it -->
        <?php if(isset($passerror)):?>
          <div>
            <?php echo $passerror;?>
          </div>
        <?php endif;?>
        <div class = "myPassword">
          <label for="password">Password:<br  /></label>
          <noscript><input
            type="password"
            name="password2"
            class = "required"
            id="password2"
            placeholder="************"
            required
          /></noscript>
        </div>
        <div>
          <label for="password2">Re-type Password:</label>
          <input
            type="password"
            name="password2"
            class = "required"
            id="password2"
            placeholder="************"
            required
          />
        </div>
        <input type="submit" name="submit" value="Register" id="submit"/>
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

    <!-- Script/css for password strength validator -->
    <script src="scripts/password_strength_lightweight.js"></script>
    <link rel="stylesheet" href="css/password_strength.css">
  </body>
</html>
