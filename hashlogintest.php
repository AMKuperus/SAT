<!DOCTYPE html>
<?php
  $pass = 'qQ1!QWERTY';
  $hash = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 12]);

  if(password_verify('qQ1!QWERTY', $hash)) {
    echo "Valid";
  } else {
    echo "Invalid";
  }
?>
