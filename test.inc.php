<?php
##Student include
//pass along $db variable in instance
$w = new Storage($db);
//$x = new Bike();
//$y = new Car();
//$z = new Spaceship();
//creates new instance of Student class (child of User)
//echo '<p>Welcome ' . $x->userName . '</p>';
//$x->testPedals();
//$y->testEngine();
//$z->sayTestFly('in Andromeda');

echo '<form class="" action="" method="POST">
      <input type=text name=activityID><br>
      <input type=text name=activity><br>
      <input type=text name=type><br>
      <input type=date name=startDate><br>
      <input type=number name=difficulty><br>
      <input type=number name=satisfaction><br>
      <input type=text name=notes><br>
      <input type=submit name=submit>
      <input type=submit name=finish value=finish>
      </form>';
if (isset($_POST['finish'])) {
  $w->postData();
  $w->finishActivity();
}

echo '<p>Welcome ' . $x->userName . '</p>';
$x->testPedals();
$y->testEngine();
$z->sayTestFly('rifter');

echo '<form method=POST>
        <input type=text name=insert>
        <input type=submit>
      </form>';

$t = new Test();
$t->showField();
?>
