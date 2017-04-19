<?php

class Monitor extends User {
//class for monitor functionality

  //method to call viewStudentProgress method from Storage class
  public function callViewStudentProgress($db){
    $storage = new Storage($db);
    $viewStudent = $storage->viewStudentProgress();
  }

  //method to call viewGroupProgress methodfrom Storage class
  public function callViewGroupProgress($db) {
    $storage = new Storage($db);
    $viewGroup = $storage->viewGroupProgress();
  }

  //method to call viewStudentProgress method from Storage class
  public function callViewAllStudentProgress($db) {
    $storage = new Storage($db);
    $viewAll = $storage->viewAllStudentProgress();
  }

  //method to call assignGroup method from Storage class
  public function callAssignGroup($db) {
    $storage = new Storage($db);
    $assign = $storage->assignGroup();
  }
}

?>
