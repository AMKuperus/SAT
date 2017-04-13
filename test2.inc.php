<?php

$x = new Storage($db);
$y = new Student($db, $user);
$z = new Monitor($db, $user);

echo '<form style=font-family:sans-serif; action="" method="POST">
UserID   <input type=text name=userId><br>
GroupID   <input type=text name=groupID><br>
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
      <br>
      </form>';
//$test runs returnGroup method from Storage class
$test = $x->returnGroup();
//runs createSelectBox function from functions.inc with array from returnGroup method
createSelectBox($test);

if (isset($_POST['submit'])) {
  $x->postData();
  //$z->callAssignGroup();
  $x->returnGroup();
}

?>
