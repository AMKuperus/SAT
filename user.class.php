<?php

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
    $this->firstName =   "";
    $this->lastName  =   "";
    $this->email     =   "";
    $this->userName  =   "";
    $this->role      =   "";
    $this->db = $db;

  }
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
//method to call the editActivities method from Storage class
  public function callEditActivities() {
    $storage = new Storage($this->db);
    $edit = $storage->editActivities();
}
//method to call the finishActivity method from Storage class
  public function callFinishActivity() {
    $storage = new Storage($this->db);
    $finish = $storage->finishActivity();
  }
}
class Monitor extends User {
  //monitor functionality
//method to call viewStudentProgress method from Storage class
  public function callViewStudentProgress(){
    $storage = new Storage($this->db);
    $studentProgress = $storage->viewStudentProgress();
  }
  public function callViewGroupProgress() {
    $storage = new Storage($this->db);
    $groupProgress = $storage->viewGroupProgress();
  }
  public function callViewAllStudentProgress() {
    $storage = new Storage($this->db);
    $allStudents = $storage->viewAllStudentProgress();
  }
  public function callAssignGroup() {
    $storage = new Storage($this->db);
    $assign = $storage->assignGroup();
  }
}
 ?>
