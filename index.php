<!DOCTYPE html>
<html>
<?php
  //Make sure to use strict mode for session as security measure.
  ini_set('session.use_strict_mode', 1);
  //Set the default timezone for the server
  date_default_timezone_set("Europe/Amsterdam");
  require 'head.inc.php';
  sessionStart();
  sessionRegenerate();
  sessionLogout();
  //http://php.net/manual/en/function.session-create-id.php
  //https://www.security.nl/posting/29281/PHP+sessions%3B+hoe+het+wel+moet

  function sessionStart() {
    //Defend against use off old session IDs
    if (!empty($_SESSION['old_time']) && $_SESSION['old_time'] < time() - 360) {
      session_destroy();
      session_start();
      echo "<p>session start</p>";
    }
  }

  function sessionRegenerate() {
    if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
    $id = session_id('sessie' . time());//Think about what to use as prefix (polymorp encrypted ip + token?)
    //Set timestamp to keep already for new session regeneration
    $_SESSION['old_time'] = time();
    //Finish
    session_commit();
    ini_set('session.use_strict_mode', 0);
    //session_id($id);
    session_start();
    //Testing SESSION stuff remove when tested.
    echo "<p>Session regenerate</p>" . date('H:i:s d/m/Y', $_SESSION['old_time']) . '[' .  $_SESSION['old_time'] . ']<br>';
    echo 'Session_id: ' . $id;
  }

  //only for testing remove when done
  echo "<hr>| testUser | testStudent | testMonitor | testAdmin :: qQ1!QWERTY |<hr>";

?>
<body>
  <h1>Student Activity Tracker</h1>
  <?php

  //Frontend controller
  //See if there is a user in $_SESSION['user']
  if(isset($_SESSION['userName']) && isset($_SESSION['role'])) {
    //Create user from $_SESSION['user']
    $user = new User($db, getUser($db, $_SESSION['userName']));
    $userName = $user->userName;
    if($user->role == $_SESSION['role']) {
      //Retrieve role from user
      $role = $user->role;
    }
  } else {
    $role = '';
  }
      switch($role) {
      case 'REG':
        include 'user.inc.php';
        break;
      case 'STU':
        include 'student.inc.php';
        break;
      case 'MON':
        include 'monitor.inc.php';
        break;
      case 'ADM':
        include 'admin.inc.php';
        break;
      default:
        include 'login.inc.php';
    }

  ?>
</body>
</html>
