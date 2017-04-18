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
      $sql = "SELECT * FROM sat.activity";
      $ask = $this->db->prepare($sql);
      $ask->bindParam(':activityID', $_POST['activityID'], PDO::PARAM_STR);
      $ask->execute();
      $result = $ask->fetch();
      echo $result['activity']. ' '. $result['type']. ' '. $result['startDate']. ' '. $result['difficulty']. ' '. $result['satisfaction']. ' '. $result['notes'];

  }
  //method to write the student's initial activity to the database
    public function insertActivity() {
      $sql = "INSERT INTO sat.activity (
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
      $ask = $this->db->prepare($sql);
      $ask->bindParam(':activity', $_POST['activity'], PDO::PARAM_STR);
      $ask->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
      $ask->bindParam(':startDate', $_POST['startDate'], PDO::PARAM_STR);
      // use PARAM_STR even though the input is a number
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
//method to view a student's progress based on the userId connected to the student
    public function viewStudentProgress() {
      $sql = "SELECT activity,type,startDate,endDate,satisfaction,difficulty,notes FROM sat.activity WHERE userId = :userId";
      $ask = $this->db->prepare($sql);
      $ask->bindParam(':userId', $_POST['userId'], PDO::PARAM_STR);
      $ask->execute();
      $result = $ask->fetchAll();
        foreach($result as $row) {
          echo $row['activity']. ' - ' .$row['type']. ' - '. $row['startDate'].
          ' - '.$row['endDate']. ' - ' .$row['satisfaction']. ' - '. $row['difficulty']. ' - ' .$row['notes']. ' ';

}
  }
//method to view a group's activities, selects all activities from activity TABLE
//selects by groupID
    public function viewGroupProgress() {
      $sql = "SELECT activity,type,startDate,endDate,satisfaction,difficulty,notes FROM sat.activity WHERE groupID = :groupID";
      $ask = $this->db->prepare($sql);
      $ask->bindParam(':groupID', $_POST['groupID'], PDO::PARAM_STR);
      $ask->execute();
      $result = $ask ->fetchAll();
        foreach($result as $row) {
          echo $row['activity']. ' - ' .$row['type']. ' - ' .$row['startDate'].
          ' - ' .$row['endDate']. ' - ' .$row['satisfaction']. ' - ' .$row['difficulty']. ' - ' .$row['notes']. ' <br>';
        }
    }
  //method to view the progress of all students registered in SAT
    public function viewAllStudentProgress() {
      $sql = "SELECT activity,type,startDate,endDate,satisfaction,difficulty,notes FROM sat.activity";
      $ask = $this->db->prepare($sql);
      $ask->execute();
      $result = $ask->fetchAll();
        foreach($result as $row) {
          echo $row['activity']. ' - ' .$row['type']. ' - ' .$row['startDate'].
          ' - ' .$row['endDate']. ' - ' .$row['satisfaction']. ' - ' .$row['difficulty']. ' - ' .$row['notes']. ' <br>';
      }
    }
    public function assignGroup() {
      $sql = "INSERT INTO sat.activity SELECT groupID FROM sat.groups WHERE userId = userId:";
      $ask->bindParam(':groupID', $_POST['groupID'], PDO::PARAM_STR);
      $ask->bindParam(':userId', $_POST['userId'], PDO::PARAM_STR);
      $ask = $this->db->prepare($sql);
      $ask->execute();
    }

    //Retun a array[] with groupID and group from sat.groups
    public function returnGroups() {
      $sql = "SELECT groupID, `group` FROM sat.groups";
      $ask = $this->db->prepare($sql);
      $ask->execute();
      $arr = [];
      while ($ret = $ask->fetch()) {
        $arr += array($ret['groupID'] => $ret['group']);
      }
      return $arr;
    }

    //Return a array[] with the roles and roleID from sat.role
    public function returnAllRoles() {
      $sql = "SELECT role, roleID FROM sat.role";
      $ask = $this->db->prepare($sql);
      $ask->execute();
      //get each result from db with a while loop
      $arr = [];
      while ($ret = $ask->fetch()) {
        //push the data into $arr[]
        $arr += array($ret['roleID'] => $ret['role']);
      }
      //return teh array
      return $arr;
    }
}
 ?>
