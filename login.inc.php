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
//TODO DB function for checking username/password match
//TODO different permissions = different parts of php per role
//TODO isset checks fields
//TODO error when username/password not there
  //(one error for all so we never reveal what the problem might be)
##Login page include

  require_once 'jumper.inc.php';
  include 'functions.inc.php';
//TODO fix this this is noy working, createHash function creates deifferent results
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['userName']) && isset($_POST['pass'])) {
      $username = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
      //$password = createHash($_POST['pass']);
      $password = $_POST['pass'];
      $hashpw = createHash($password);
      $pc = logUser($db, $username);
      print_r($pc);
      $ppc = implode($pc);
      //TODO Check if the passCode's match
      if(password_verify($password, $ppc)) {
        echo "<h1>CHECK</h1>";
      } else {
        echo "dang....";
      }
      $one = createHash($password);
      $two = createHash($password);

      echo "<div class=box style=z-index:999><br><code>input: $password</code>
            <br><code>hash: $hashpw</code>
            <br><code>DB: $ppc</code><br>
            <br>$one
            <br>$two</div>";

    } else {
      //warning for not filling in field
    }
  }
?>
