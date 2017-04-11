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
    echo "<p>Session regenerate</p>" . date('H:i:s d/m/Y', $_SESSION['old_time']) . '[' .  $_SESSION['old_time'] . ']<br>';
    echo $id;
  }

?>
<body>
  <h1>Student Activity Tracker</h1>
  <!--switch to include login or studentpages or teacherpages detected from sessionvariable-->
  <?php
    require_once 'jumper.inc.php';
    include 'storage.class.php'; include 'user.class.php'; //include 'test.class.php';
    include 'login.inc.php';     //include 'test.inc.php';
  ?>
  <div class='box'>
    <?php include 'test2.inc.php'; ?>
  </div>
</body>
</html>
