<?php
##Student include
$x = new Bike();
$y = new Car();
$z = new Spaceship();
//creates new instance of Student class (child of User)
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
