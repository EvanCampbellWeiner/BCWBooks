<!--
  Page Name: register.html
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:




  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
-->
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

      <a href="home.html" id="homeButton">Home</a>
      <a href="index.html" id="libraryButton">Library</a>
      <a href="register.html" id="accountButton">Register</a>
      <a href="login.html" id="loginButton">Login</a>
    </header>
    <main>
      <form id="register" action="register.php" method="post">
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
        <button type="submit" name="register">Register</button>
      </form>
    </main>
  </body>
</html>