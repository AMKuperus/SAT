<?php

$x = new Storage($db);
$y = new Student($db);

echo '<form class="" action="" method="POST">
      <input type=text name=activityID><br>
      <input type=text name=activity><br>
      <input type=text name=type><br>
      <input type=date name=startDate><br>
      <input type=number name=difficulty><br>
      <input type=number name=satisfaction><br>
      <input type=text name=notes><br>
      <input type=submit name=submit>
      </form>';
if (isset($_POST['submit'])) {
  $x->postData();
  $y->callViewActivities();
}

?>
