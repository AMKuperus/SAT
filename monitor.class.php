<?php

class Monitor extends User {
//class for monitor functionality

  //method to call viewStudentProgress method from Storage class
  public function callViewStudentProgress($db){
    $storage = new Storage($db);
    $studentProgress = $storage->viewStudentProgress();
  }

  //method to call viewGroupProgress methodfrom Storage class
  public function callViewGroupProgress($db) {
    $storage = new Storage($db);
    $groupProgress = $storage->viewGroupProgress();
  }

  //method to call viewStudentProgress method from Storage class
  public function callViewAllStudentProgress($db) {
    $storage = new Storage($db);
    $allStudents = $storage->viewAllStudentProgress();
  }

  //method to call assignGroup method from Storage class
  public function callAssignGroup($db) {
    $storage = new Storage($db);
    $assign = $storage->assignGroup();
  }
}

?>
