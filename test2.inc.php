<?php

$x = new Storage($db);
$y = new Student($db);
$z = new Monitor($db);

echo '<form class="" action="" method="POST">
<span class=small>UserID</span>   <input type=text name=userId><br>
<span class=small>GroupID</span>   <input type=text name=GroupID><br>
<span class=small>ActivityID</span>      <input type=text name=activityID><br>
<span class=small>Activity</span>      <input type=text name=activity><br>
<span class=small>Type</span>      <input type=text name=type><br>
<span class=small>startDate</span>      <input type=date name=startDate><br>
<span class=small>difficulty</span>      <input type=number name=difficulty><br>
<span class=small>satisfaction</span>      <input type=number name=satisfaction><br>
<span class=small>notes</span>      <input type=text name=notes><br>
      <input type=submit name=submit>
      <input type=submit name=finish value="Finish activity">
      </form>';
if (isset($_POST['submit'])) {
  $x->postData();
  $z->callViewStudentProgress();
}

?>
