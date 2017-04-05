<?php
##Student include
$x = new Student();
//creates new instance of Student class (child of User)
echo '<p>Welcome ' . $x->userName . '</p>';
$x->testFunction();
?>
