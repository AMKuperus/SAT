<?php
##############################################################################
##########################@author : AMKuperus#################################
####Copyleft,only to be used for non-profit and always mention the author.####
##############################Functions for SAT###############################
##############################################################################

  //Empty $_SESSION['userName'] and unset $_SESSION['userName'] to logout a user.
  function sessionLogout() {
    if(isset($_POST['logout'])) {
      $_SESSION['userName'] = '';
      unset($_SESSION['userName']);
    }
  }

  //Create a button for logout
  function logoutBtn() {
    echo '<form method="POST" action="">
          <button type="submit" value="logout" name="logout">Logout</button>
          </form>';
  }

  //Create a value-element for the html-inputfield of the form with the value
  //the user has already submitted so that if they need to correct something they
  //do not have to fill in the complete form again.
  //$element is the element that was filled in, like userName/firstName
  function setValue($element) {
    global $user;
    if(isset($user[$element])) {
      $content = $user[$element];
      return 'value="' . $content . '" ';
    }
  }

  //TODO Encrypt function for encrypring $_SESSION data
  //function encryptThis() {

  //}

  //TODO Decrypt function for decrypting $_SESSION data
  //function decryptThis() {

  //}

  //If $pass is bigger then or 10 and smaller then 72(limit for BCRYPT) return true
  function passLength($pass) {
    if(strlen($pass) >= 10 && strlen($pass) < 72) {
      return true;
    }
  }

  //Check if $pass contains small letter capital digit and special char and returns true if so.
  function passContains($pass) {
    //Check for small letters a-z
    $letter = preg_match('/[a-z]/', $pass);
    //Check for capital letters A-Z
    $capital = preg_match('/[A-Z]/', $pass);
    //Check for digits \d
    $digit = preg_match('/\d/', $pass);
    //Check for special characters ^a-zA-Z\d (if there is anything else then a-z/A-Z/\d)
    $special = preg_match('/[^a-zA-Z\d]/', $pass);
    if($letter && $capital && $digit && $special) {
      return true;
    }
  }

  //Creates a hash from $p
  function createHash($p) {
    $return = password_hash($p, PASSWORD_BCRYPT, ['cost' => 12]);
    return $return;
  }

  //Send a new user a email with the verification-link
  function verMail($user, $token) {
    require 'phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    include 'mailconfig.inc.php';
    $mail->AddAddress($user['email'], $user['firstName'] . ' ' . $user['lastName']);
    $mail->isHTML(true);
    //Create the activationlink for the message-body
    $link = $mailUrl . '/SAT/activate.php?id=' . $user['userName'] . '&t='. $token;
    //Create head/body
    $mail->Subject = "Your verification mail from ITVitae-TAS";
    $mail->Body = '<p>Thank you for registering for the ITVitae-SAT ' .  $user['firstName'] .
                  '!</p><p><a href="' . $link . '">To activate the account click here.</a>
                  </p><p></p>';

    if(!$mail->send()) {
      echo $mail->ErrorInfo;
    }
  }

  //Create a token 128bit base64_encode encodes the string so it can be safely send by email.
  //strtr replaces +/= to x to evade conflict with GET
  function createToken() {
    $token = strtr(base64_encode(openssl_random_pseudo_bytes(16)), '+/=', 'duh');
    return $token;
  }

  //Creates a html <select> from a array[]
  //$name is a optianal parameter for the name attribute
  function createSelectBox($array, $name = "") {
    echo '<select name="' . $name . '">';
    foreach($array as $k => $v) {
      echo '<option value="' . $k . '">' . $v . '</option>' . PHP_EOL;
    }
    echo '</select>';
  }
?>
