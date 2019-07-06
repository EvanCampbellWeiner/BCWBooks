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
      <h1>Account</h1>

      <a href="index.php" id="homeButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <main>
      <form id="updateAccount" action="updateAccount.php" method="post">
        <div>
          <label for="email">Email:</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="johnsmith@yahoo.ca"
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
        <button type="submit" name="changeinfo">Update</button>
        <button type="submit" name="logout">Logout</button>
      </form>
    </main>
  </body>
</html>
