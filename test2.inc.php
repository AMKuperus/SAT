<?php

$x = new Storage($db);
$y = new Student($db, $user);
$z = new Monitor($db, $user);
$u = new User($db, $user);
echo $u->userID. $u->userName;

echo '<form style=font-family:sans-serif; action="" method="POST">
UserID   <input type=text name=userId><br>
ActivityID      <input type=text name=activityID><br>
Activity     <input type=text name=activity><br>
Type     <input type=text name=type><br>
startDate      <input type=date name=startDate><br>
difficulty      <input type=number name=difficulty><br>
satisfaction     <input type=number name=satisfaction><br>
notes     <input type=text name=notes><br>
      <input type=submit name=submit>
      <input type=submit name=finish value="Finish activity">
      <br>
      <br>';

      $test = $x->returnAllRoles();
      createSelectBox($test, "role");
      //runs createSelectBox function from functions.inc with array from class method
if (isset($_POST['submit'])) {
  //$z->callAssignGroup();
  $x->removeRole();

}
echo '</form>';
?>
