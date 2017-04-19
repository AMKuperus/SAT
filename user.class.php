<?php

class User {
  //class variable, set to public for it to be used outside the class
  public $userName;
  public $userID;
  public $firstName;
  public $lastName;
  public $email;
  public $groupID;
  public $role;
  public $state;
  //public $db;
  //public $storage;

  public function __construct($db, $user) {
    //user stuff pulled from db on correct login
    $this->userName   =   $user->userName;
    $this->userID     =   $user->userID;
    $this->firstName  =   $user->firstName;
    $this->lastName   =   $user->lastName;
    $this->email      =   $user->email;
    $this->groupID    =   $user->groupID;
    $this->role       =   $user->role;
    $this->state      =   $user->state;
    //$this->db = $db;
  }
}

class Student extends User {
//student functionality
//function/method that calls viewActivities method from Storage class
  public function callViewActivities($db) {
    $storage = new Storage($db);
    $view = $storage->viewActivities();
}

//function/method that calls the insertActivity method from Storage class
  public function callInsertActivity($db) {
    $storage = new Storage($db);
    $insert = $storage->insertActivity();
}

//method to call the editActivities method from Storage class
  public function callEditActivities($db) {
    $storage = new Storage($db);
    $edit = $storage->editActivities();
}

//method to call the finishActivity method from Storage class
  public function callFinishActivity($db) {
    $storage = new Storage($db);
    $finish = $storage->finishActivity();
  }
}

class Monitor extends User {
  //monitor functionality
//method to call viewStudentProgress method from Storage class
  public function callViewStudentProgress($db){
    $storage = new Storage($db);
    $studentProgress = $storage->viewStudentProgress();
  }

  public function callViewGroupProgress($db) {
    $storage = new Storage($db);
    $groupProgress = $storage->viewGroupProgress();
  }

  public function callViewAllStudentProgress($db) {
    $storage = new Storage($db);
    $allStudents = $storage->viewAllStudentProgress();
  }

  public function callAssignGroup($db) {
    $storage = new Storage($db);
    $assign = $storage->assignGroup();
  }
}
 ?>
