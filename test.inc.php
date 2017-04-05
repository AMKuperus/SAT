<?php
##Student include
$x = new Bike();
$y = new Car();
$z = new Spaceship();
//creates new instance of Student class (child of User)
echo '<p>Welcome ' . $x->userName . '</p>';
$x->testPedals();
$y->testEngine();
$z->sayTestFly();
?>
