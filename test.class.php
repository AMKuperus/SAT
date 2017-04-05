<?php
//instance to create a new class named User
class Test {
  //class variable, set to public for it to be used outside the class
  public $userName;
  public $insert;

  public function __construct() {
    //user stuff pulled from db on correct login
    $this->userName = 'Puk van de Petterflet';
    $this->insert = filter_input(INPUT_POST, 'insert', FILTER_SANITIZE_STRING);
  }

  public function showField() {
    echo 'Test: ';
    echo $this->insert;
  }

//protected class variables, only to be used inside superclass and child classes
//public function can be called outside the class
//private function can only be used inside the class

}

class Bike extends Test {
    //student functionality


//test function to be removed on final version
  public function testPedals() {
    echo "<p>Knoink rusty chain</p>";
  }
}

class Car extends Test {
  //test function
  public function testEngine() {
    echo '<p><code>Brrrrrrrrrrrr V8</code></p>';
  }
}

class Spaceship extends Test {
  //test functin private
  private function testFly($ship) {
    echo '<h1>We are flying high!</h1><p>I love my ' . $ship . '</p>';
  }

  public function sayTestFly($ship) {
    $this->testFly($ship);
  }
}
 ?>
