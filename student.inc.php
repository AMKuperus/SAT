<?php
##Student include
$x = new Student();
$y = new Monitor();
$z = new Admin();
//creates new instance of Student class (child of User)
echo '<p>Welcome ' . $x->userName . '</p>';
$x->testFunction();
$y->testMonitor();
$z->testAdmin();
?>
