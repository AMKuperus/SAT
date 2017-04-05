<?php
//instance to create a new class named User
class Test {
  //class variable, set to public for it to be used outside the class
  public $userName;

  public function __construct() {
    //user stuff pulled from db on correct login
    $this->userName = 'Puk van de Petterflet';
  }

//protected class variables, only to be used inside superclass and child classes
//public function can be called outside the class
//private function can only be used inside the class

}

class Bike extends Test {
    //student functionality


//test function to be removed on final version
  public function testPedals() {
    echo "Knoink rusty chain";
  }
}

class Car extends Test {
  //test function
  public function testEngine() {
    echo 'Brrrrrrrrrrrr V8';
  }
}

class Spaceship extends Test {
  //test functin private
  private function testFly() {
    echo '<h1>We are flying high!</h1>';
  }

  public function sayTestFly() {
    $this->testFly();
  }
}
 ?>
