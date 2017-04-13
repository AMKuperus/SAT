<?php
class Storage {

  public $userName;
  public $activity;
  public $activityID;
  public $userId;
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
//method to retrieve data from post and run through filter_input
    public function postData() {
      $this->activityID = filter_input(INPUT_POST, 'activityID', FILTER_SANITIZE_NUMBER_INT);;
      $this->activity = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
      $this->type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
      $this->startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_NUMBER_INT);
      $this->difficulty = filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_INT);
      $this->satisfaction = filter_input(INPUT_POST, 'satisfaction', FILTER_SANITIZE_NUMBER_INT);
      $this->notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
  }

//method to view activities
    public function viewActivities() {
      $id = $this->activityID;
      $stmt = "SELECT * FROM sat.activity";
      $sql = $this->db->prepare($stmt);
      $sql->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_STR);
      $sql->execute();
      $result = $sql->fetch();
      echo $result['activity']. ' '. $result['type']. ' '. $result['startDate']. ' '. $result['difficulty']. ' '. $result['satisfaction']. ' '. $result['notes'];

  }
  //method to write the student's initial activity to the database
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
//method for student to edit/update their activities
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
//method to add an end date to the activity when student clicks 'finish' to close
//an activity
//this method creates a timestamp and sets it to day-month-year hour-minute-seconds
//timezone is set to Europe/Amsterdam in index.php
    public function finishActivity() {
      $today = date('Y-m-d H:i:s');
      $stmt = "UPDATE sat.activity SET endDate = :endDate WHERE activityID = :activityID";
      $sql = $this->db->prepare($stmt);
      $sql->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_INT);
      $sql->bindParam(':endDate', $today, PDO::PARAM_STR);
      $sql->execute();
  }
//method to view a student's progress based on the userId connected to the student
    public function viewStudentProgress() {
      $stmt = "SELECT activity,type,startDate,endDate,satisfaction,difficulty,notes FROM sat.activity WHERE userId = :userId";
      $sql = $this->db->prepare($stmt);
      $sql->bindParam(':userId', $_POST['userId'], PDO::PARAM_STR);
      $sql->execute();
      $result = $sql->fetchAll();
        foreach($result as $row) {
          echo $row['activity']. ' - ' .$row['type']. ' - '. $row['startDate'].
          ' - '.$row['endDate']. ' - ' .$row['satisfaction']. ' - '. $row['difficulty']. ' - ' .$row['notes']. ' ';

}
  }
//method to view a group's activities, selects all activities from activity TABLE
//selects by groupID
    public function viewGroupProgress() {
      $stmt = "SELECT activity,type,startDate,endDate,satisfaction,difficulty,notes FROM sat.activity WHERE groupID = :groupID";
      $sql = $this->db->prepare($stmt);
      $sql->bindParam(':groupID', $_POST['groupID'], PDO::PARAM_STR);
      $sql->execute();
      $result = $sql ->fetchAll();
        foreach($result as $row) {
          echo $row['activity']. ' - ' .$row['type']. ' - ' .$row['startDate'].
          ' - ' .$row['endDate']. ' - ' .$row['satisfaction']. ' - ' .$row['difficulty']. ' - ' .$row['notes']. ' <br>';
        }
    }
  //method to view the progress of all students registered in SAT
    public function viewAllStudentProgress() {
      $stmt = "SELECT activity,type,startDate,endDate,satisfaction,difficulty,notes FROM sat.activity";
      $sql = $this->db->prepare($stmt);
      $sql->execute();
      $result = $sql->fetchAll();
        foreach($result as $row) {
          echo $row['activity']. ' - ' .$row['type']. ' - ' .$row['startDate'].
          ' - ' .$row['endDate']. ' - ' .$row['satisfaction']. ' - ' .$row['difficulty']. ' - ' .$row['notes']. ' <br>';
      }
    }
    public function assignGroup() {
      $stmt = "UPDATE sat.activity SET groupID = :groupID WHERE userId = :userId";
      $sql->bindParam(':groupID', $_POST['groupID'], PDO::PARAM_STR);
    }
//method to return the 3rd row (group) from the groups table
//fetches first row
//TODO: find out how to fetch third row
    public function returnGroups() {
      $sql = "SELECT * FROM sat.groups";
      $ask = $this->db->prepare($sql);
      $ask->execute();
      $result = $ask->fetchAll();
      var_dump($result);
      //return $ask->fetchAll(PDO::FETCH_COLUMN);
    }

    //Return a array[] with the roles and roleID
    public function returnAllRoles() {
      $sql = "SELECT role, roleID FROM sat.role";
      $ask = $this->db->prepare($sql);
      $ask->execute();
      return $ask->fetchAll(PDO::FETCH_COLUMN);
    }
}
 ?>
