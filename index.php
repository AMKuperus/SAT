<!DOCTYPE html>
<?php
  //Make sure to use strict mode for session as security measure.
  ini_set('session.use_strict_mode', 1);
  sessionStart();
  sessionRegenerate();
  //http://php.net/manual/en/function.session-create-id.php
  include 'head.inc.php';

  function sessionStart() {
    //Defend against use off old session IDs
    if (!empty($_SESSION['old_time']) && $_SESSION['old_time'] < time() - 360) {
      session_destroy();
      session_start();
    }
  }

  function sessionRegenerate() {
    if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
    $id = session_id();//Think about what to use as prefix
    //Set timestamp to keep already for net session regeneration
    $_SESSION['old_time'] = time();
    //Finish
    session_commit();
    ini_set('session.use_strict_mode', 0);
    session_id($id);
    session_start();
  }

?>
<body>
  <h1>Student Activity Tracker</h1>
  <!--switch to include login or studentpages or teacherpages detected from sessionvariable-->
  <?php
    require_once 'jumper.inc.php';
    include 'login.inc.php';   include 'user.class.php'; include 'student.inc.php';
  ?>
</body>
</html>
