<?php
class Storage {

  public $userName;
  public $activity;
  public $activityID;
  public $type;
  public $startDate;
  public $endDate;
  public $difficulty;
  public $satisfaction;
  public $notes;
  public $db;

//pass along $db variable
    public function __construct($db) {
      $this->db = $db;
    }
//function to retrieve data from post and run through filter_input
    public function postData() {
      $this->activityID = filter_input(INPUT_POST, 'activityID', FILTER_SANITIZE_NUMBER_INT);;
      $this->activity = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
      $this->type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
      $this->startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_NUMBER_INT);
      $this->difficulty = filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_INT);
      $this->satisfaction = filter_input(INPUT_POST, 'satisfaction', FILTER_SANITIZE_NUMBER_INT);
      $this->notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
  }
    public function returnData() {
      $this->postData();
    }
//function to view activities
    public function viewActivities() {
      $id = $this->activityID;
      $stmt = "SELECT * FROM sat.activity";
      $sql = $this->db->prepare($stmt);
      $sql->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_STR);
      $sql->execute();
      $result = $sql->fetch();
      echo $result['activity']. ' '. $result['type']. ' '. $result['startDate']. ' '. $result['difficulty']. ' '. $result['satisfaction']. ' '. $result['notes'];

  }
  //function to write the initial activity to the database
    public function insertActivity() {
      $stmt = "INSERT INTO sat.activity (
        sat.activity.activity,
        sat.activity.type,
        sat.activity.startDate,
        sat.activity.difficulty,
        sat.activity.satisfaction,
        sat.activity.notes
      ) VALUES (
        :activity,
        :type,
        :startDate,
        :difficulty,
        :satisfaction,
        :notes)";
      $sql = $this->db->prepare($stmt);
      $sql->bindParam(':activity', $_POST['activity'], PDO::PARAM_STR);
      $sql->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
      $sql->bindParam(':startDate', $_POST['startDate'], PDO::PARAM_STR);
      // use PARAM_STR even though the input is a number
      $sql->bindParam(':difficulty', $_POST['difficulty'], PDO::PARAM_STR);
      $sql->bindParam(':satisfaction', $_POST['satisfaction'], PDO::PARAM_STR);
      $sql->bindParam(':notes', $_POST['notes'], PDO::PARAM_STR);
      $sql->execute();
    }

    public function editActivities() {
      $stmt = "UPDATE sat.activity SET activity = :activity,
            type = :type,
            difficulty = :difficulty,
            satisfaction = :satisfaction,
            notes = :notes
            WHERE activityID = :activityID";
      $sql = $this->db->prepare($stmt);
      $sql->bindParam(':activity', $_POST['activity'], PDO::PARAM_STR);
      $sql->bindParam(':type', $_POST['$type'], PDO::PARAM_STR);
    // use PARAM_STR even though the input is a number
      $sql->bindParam(':difficulty', $_POST['difficulty'], PDO::PARAM_STR);
      $sql->bindParam(':satisfaction', $_POST['satisfaction'], PDO::PARAM_STR);
      $sql->bindParam(':notes', $_POST['notes'], PDO::PARAM_STR);
      $sql->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_INT);
      $sql->execute();
  }

//TODO: FIX below function - not functional yet
//function to add an end date to the activity when finish is clicked
//creates a timestamp and sets it into day-month-year hour-minute-seconds format
    public function finishActivity() {
      $today = date('Y-m-d H:i:s');
      echo $today;
      $stmt = "UPDATE sat.activity SET endDate = :endDate)";
      $sql = $this->db->prepare($stmt);
      //PDO:PARAM_STR used for date/timestamp, perhaps incorrect paramater usage
      $sql->bindParam(':endDate', $today, PDO::PARAM_STR);
      $sql->execute();
  }
}
 ?>
