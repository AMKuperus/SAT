
<?php
//TODO Build up environment for safe session
  //start session->login
    //session id token (ip-log?)
    //settimeout session
    //renew token if there is activity, else destroy session
    //start_session()-session_id()-session_cache_expire()-session_regenate_id()
//TODO attach in session the role of the user
//TODO different permissions = different parts of php per role
##Login page include

echo '<form class="box loginbox" action="" method="POST">
      <h2>Login</h2>';

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_POST['userName']) || !isset($_POST['pass']) || empty($_POST['userName']) || empty($_POST['pass'])) {
      echo "<small class=error>Wrong input. Try again or register.</small>";
    } else {
      $username = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
      //Grab the password from the database
      $password = logUser($db, $username);
      // Check if the password is match
      if(password_verify($_POST['pass'], $password)) {
        //TODO do something with the session so we can identify the user
        //TODO write function encrypt and decrypt in functions.inc for use here
        $user = new User($db, getUser($db, $username));
        $_SESSION['userName'] = $user->userName;
        //$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-ctr'));
        //$_SESSION['usr'] = openssl_encrypt($user->userName, 'AES-256-CTR', 'itvitae', 0, $iv);
        //Create token/timestamp/encrypted cookie
        echo '<code>Welcome ' . $user->firstName . '!</code>';
      } else {
        echo "<small class=error>Wrong input. Try again or register.</small>";
      }
    }
  }
  echo  '<p>Username: <input type="text" name="userName" placeholder="username"></p>
        <p>Password: <input type="password" name="pass" placeholder="**********" max="72"></p>
        <input id="loginbtn" type="submit" value="Login">
        <a href="register.php">New user registration</a>
        </form>';
?>
