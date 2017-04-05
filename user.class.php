<?php
//instance to create a new class named User
class User {
  //class variable, set to public for it to be used outside the class
  public $firstName;
  public $lastName;
  public $email;
  public $pass;
  public $state;
  public $token;
  public $userName;

  public function __construct() {
    //user stuff pulled from db on correct login
    $this->userName = 'Puk van de Petterflet';
  }

//protected class variables, only to be used inside superclass and child classes
//public function can be called outside the class
//private function can only be used inside the class

}

class Student extends User {
    //student functionality


//test function to be removed on final version
  public function testFunction() {
    echo "Test";
  }
}
 ?>
