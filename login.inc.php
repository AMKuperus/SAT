<form class="box loginbox" action="" method="POST">
  <h2>Login</h2>
  <p>Username: <input type="text" name="userName" placeholder="your.name"></p>
  <p>Password: <input type="password" name="pass" placeholder="**********" max="70"></p>
  <input id="loginbtn" type="submit" value="Login">
  <a href="register.php">New user registration</a>
</form>
<?php
//TODO Build up environment for safe session
  //start session->login
    //session id token (ip-log?)
    //settimeout session
    //renew token if there is activity, else destroy session
    //start_session()-session_id()-session_cache_expire()-session_regenate_id()
//TODO attach in session the role of the user
//TODO different permissions = different parts of php per role
//TODO isset checks fields
##Login page include

  require_once 'jumper.inc.php';
  include 'functions.inc.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_POST['userName']) || !isset($_POST['pass']) || empty($_POST['userName']) || empty($_POST['pass'])) {
      echo "<code>Wrong input. Try again or register.</code>";
    } else {
      $username = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
      //Grab the password from the database
      $password = logUser($db, $username);
      // Check if the passwor is match
      if(password_verify($_POST['pass'], $password)) {
        echo "<code>Welcome $username</code>";
        //TODO do something with the session so we can identify the user
      } else {
        echo "<code>Wrong input. Try again or register.</code>";
      }
    }
  }
?>
