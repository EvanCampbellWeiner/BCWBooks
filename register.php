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


  //To be done:
  //- check password length
  //- check password for various characters
  include "includes/library.php";
  session_start();
  $pdo = connectdb();
  if(isset($_POST['submit']))
  {
    $psw = $_POST['password'];
    $psw2 = $_POST['password2'];
    $email = $_POST['email'];
    $options = array('cost' => 12);
    $hashpsw = password_hash($psw, PASSWORD_DEFAULT, $options);
    $sql = "select username_email from bcwBooks_users where username_email = ?";
    $statement = $pdo -> prepare($sql);
    $statement->execute([$email]);
    $result = $statement->fetch();
    if(strlen($psw)<8){
      $passerror = "Error: Password must be more then 8 characters";
    }
    else if($psw != $psw2)
    {
      $passerror = "Error: Passwords do not match.";
    }
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
  /*  $email = $_POST['email'];
    $psw = $_POST['password'];
    $sql = "select * from bcwBooks_users where username_email =?";*/
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register</title>
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
      <h1>Register</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <main>
      <form id="register" action="register.php" method="POST">
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
        <?php if(isset($passerror)):?>
          <div>
            <?php echo $passerror;?>
          </div>
        <?php endif;?>
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
        <input type="submit" name="submit" value="Register" id="submit"/>
      </form>
    </main>
  </body>
</html>
