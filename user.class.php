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
  public $role;
  public $db;
  public $storage;

  public function __construct($db) {
    //user stuff pulled from db on correct login
    $this->db = $db;
    $this->userName = 'Puk van de Petterflet';
  }

//protected class variables, only to be used inside superclass and child classes
//public function can be called outside the class
//private function can only be used inside the class

}

class Student extends User {
    //student functionality
//function/method that calls viewActivities method from Storage class
  public function callViewActivities() {
    $storage = new Storage($this->db);
    $view = $storage->viewActivities();
}
//function/method that calls the insertActivity method from Storage class
  public function callInsertActivity() {
    $storage = new Storage($this->db);
    $insert = $storage->insertActivity();
}
  public function callEditActivities() {
    $storage = new Storage($this->db);
    $edit = $storage->editActivities();
}

//test function to be removed on final version
  public function testFunction() {
    echo "Test";
  }
}
 ?>
