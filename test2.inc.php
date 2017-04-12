<?php

$x = new Storage($db);
$y = new Student($db);
$z = new Monitor($db);

/*echo '<form style=font-family:sans-serif; action="" method="POST">
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
      <select>
        <option value="PHP" name=group>PHP</option>
        <option value="HTML" name=html>HTML</option>
      </select>

      </form>';*/
echo '<form style=font-family:sans-serif; action="" method="POST">
UserID   <input type=text name=userId><br>
<br>
<br>
<select>
<option value="PHP" name=groupID>PHP</option>
<option value="HTML" name=groupID>HTML</option>
<input type=submit name=submit>
</select>
</form>';




if (isset($_POST['submit'])) {
  $x->postData();
  //$z->callAssignGroup();
  $x->allGroups();
}

?>
