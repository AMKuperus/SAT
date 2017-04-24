
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
if(!isset($_SESSION['userName'])) {
  echo '<form class="box loginbox" action="" method="POST" onSubmit="window.location.reload()">
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
          //create User after succesfull registration
          $user = new User($db, getUser($db, $username));
          $_SESSION['userName'] = $user->userName;
          $_SESSION['role'] = $user->role;
          $redirect = $_SERVER['PHP_SELF'];
          echo "<code>Welcome $user->firstName $user->lastName! <br>
                You will be redirected hang on...<br>
                <a href=\"$redirect\">Too slow? click here...</a></code>";
          //TODO write function encrypt and decrypt in functions.inc for use here
          //$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-ctr'));
          //$_SESSION['usr'] = openssl_encrypt($user->userName, 'AES-256-CTR', 'itvitae', 0, $iv);
          //TODO Create token/timestamp/encrypted cookie

          //Refresh the page so the user gets redirected to their section.
          header("Refresh:0");
          //echo "<meta http-equiv='refresh' content='0'>";
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
  }
?>
