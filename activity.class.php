<?php

class Activity {

  public $db;

//constructor set in place to receive $db variable and set it as an internal class variable
  public function __construct($db) {
    $this->db = $db;
  }

  //method to view activities
  public function viewActivities() {
    $sql = "SELECT * FROM sat.activity";
    $ask = $this->db->prepare($sql);
    $ask->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_STR);
    $ask->execute();
    $result = $ask->fetch();
    //temporary echo, may change when implemented
    echo $result['activity']. ' '. $result['type']. ' '. $result['startDate']. ' '. $result['difficulty']. ' '. $result['satisfaction']. ' '. $result['notes'];
}

  //method to write the student's initial activity to the database
  public function insertActivity() {
    $sql = "INSERT INTO sat.activity (
      activity, type, startDate, difficulty, satisfaction, notes
      ) VALUES (
      :activity, :type, :startDate, :difficulty, :satisfaction, :notes)";
    $ask = $this->db->prepare($sql);
    $ask->bindParam(':activity', $_POST['activity'], PDO::PARAM_STR);
    $ask->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
    $ask->bindParam(':startDate', $_POST['startDate'], PDO::PARAM_STR);
    $ask->bindParam(':difficulty', $_POST['difficulty'], PDO::PARAM_STR);
    $ask->bindParam(':satisfaction', $_POST['satisfaction'], PDO::PARAM_STR);
    $ask->bindParam(':notes', $_POST['notes'], PDO::PARAM_STR);
    $ask->execute();
  }

  //method for student to edit/update their activities
  public function editActivities() {
    $sql = "UPDATE sat.activity SET activity = :activity,
          type = :type,
          difficulty = :difficulty,
          satisfaction = :satisfaction,
          notes = :notes
          WHERE activityID = :activityID";
    $ask = $this->db->prepare($sql);
    $ask->bindParam(':activity', $_POST['activity'], PDO::PARAM_STR);
    $ask->bindParam(':type', $_POST['$type'], PDO::PARAM_STR);
  // use PARAM_STR even though the input is a number
    $ask->bindParam(':difficulty', $_POST['difficulty'], PDO::PARAM_STR);
    $ask->bindParam(':satisfaction', $_POST['satisfaction'], PDO::PARAM_STR);
    $ask->bindParam(':notes', $_POST['notes'], PDO::PARAM_STR);
    $ask->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_INT);
    $ask->execute();
  }

  //method to add an end date to the activity when student clicks 'finish' to close
  //an activity
  //this method creates a timestamp and sets it to day-month-year hour-minute-seconds
  //timezone is set to Europe/Amsterdam in index.php
  public function finishActivity() {
    $today = date('Y-m-d H:i:s');
    $sql = "UPDATE sat.activity SET endDate = :endDate WHERE activityID = :activityID";
    $ask = $this->db->prepare($sql);
    $ask->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_INT);
    $ask->bindParam(':endDate', $today, PDO::PARAM_STR);
    $ask->execute();
  }
}
 ?>
