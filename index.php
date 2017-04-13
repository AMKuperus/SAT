<!DOCTYPE html>
<?php
  //Make sure to use strict mode for session as security measure.
  ini_set('session.use_strict_mode', 1);
  //Set the default timezone for the server
  date_default_timezone_set("Europe/Amsterdam");
  sessionStart();
  sessionRegenerate();
  //http://php.net/manual/en/function.session-create-id.php
  //https://www.security.nl/posting/29281/PHP+sessions%3B+hoe+het+wel+moet
  include 'head.inc.php';

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

?>
<body>
  <h1>Student Activity Tracker</h1>
  <!--switch to include login or studentpages or teacherpages detected from sessionvariable-->
  <?php
  require_once 'jumper.inc.php';
  include 'storage.class.php'; include 'user.class.php';

  $role = '';//TODO create funtion for retrieveing role and add it here from userclass??
    switch($role) {
      case 'user':
        include 'user.inc.php';
        break;
      case 'student':
        include 'student.inc.php';
        break;
      case 'monitor':
        include 'monitor.inc.php';
        break;
      case 'admin':
        include 'admin.inc.php';
        break;
      default:
        include 'login.inc.php';
    }

    $user = getUser($db, 'testuser');
    var_dump($user);
    echo '<hr>';
    $test = new User($db, $user);
    var_dump($test);
    echo '<hr>';
    echo $test->userName . $test->userID;
    echo '<div class=box style=z-index:1>';
    $c = new Storage($db);
    $roles = $c->returnAllRoles();
    var_dump($roles);
    createSelectBox($roles);
    echo '</div';
  ?>

  <!--                    Cleanup this part and organize                     -->
  <?php

    //include 'test.class.php'; //include 'test.inc.php';
  ?>
  <div class='box'>
    <?php include 'test2.inc.php'; ?>
  </div>
</body>
</html>
