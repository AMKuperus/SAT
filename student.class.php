<?php

class Student extends User {
//class for student functionality

//function/method that calls viewActivities method from Activity class
  public function callViewActivities($db) {
    $activity = new Activity($db);
    $view = $activity->viewActivities();
}

//function/method that calls the insertActivity method from Activity class
  public function callInsertActivity($db) {
    $activity = new Activity($db);
    $insert = $activity->insertActivity();
}

//method to call the editActivities method from Activity class
  public function callEditActivities($db) {
    $activity = new Activity($db);
    $edit = $activity->editActivities();
}

//method to call the finishActivity method from Activity class
  public function callFinishActivity($db) {
    $activity = new Activity($db);
    $finish = $activity->finishActivity();
  }
}

?>
