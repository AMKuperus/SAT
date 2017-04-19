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

 ?>
