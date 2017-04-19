<?php
class Storage {

  public $db;

    //pass along $db variable
    public function __construct($db) {
      $this->db = $db;
    }

    //method to view a student's progress based on the userId connected to the student
    public function viewStudentProgress() {
      $sql = "SELECT activity,type,startDate,endDate,satisfaction,difficulty,notes FROM sat.activity WHERE userId = :userId";
      $ask = $this->db->prepare($sql);
      $ask->bindParam(':userId', $_POST['userId'], PDO::PARAM_STR);
      $ask->execute();
      $result = $ask->fetchAll();
        //temporary foreach + echo, may change when implemented
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
      //temporary foreach + echo, may change when implemented
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
      //temporary foreach + echo, may change when implemented
        foreach($result as $row) {
          echo $row['activity']. ' - ' .$row['type']. ' - ' .$row['startDate'].
          ' - ' .$row['endDate']. ' - ' .$row['satisfaction']. ' - ' .$row['difficulty']. ' - ' .$row['notes']. ' <br>';
      }
    }

    //method for monitor to assign group to user in user table
    public function assignGroup() {
      $sql = "UPDATE sat.users SET groupID = :groupID WHERE userId = :userId";
      $ask = $this->db->prepare($sql);
      $ask->bindParam(':groupID', $_POST['groupID'], PDO::PARAM_STR);
      $ask->bindParam(':userId', $_POST['userId'], PDO::PARAM_STR);
      $ask->execute();
    }

    //method to update role to a user from a select box
    public function updateRole() {
      $sql = "UPDATE sat.users SET role = :role WHERE userId = :userId";
      $ask = $this->db->prepare($sql);
      $ask->bindParam(':role', $_POST['role'], PDO::PARAM_STR);
      $ask->bindParam(':userId', $_POST['userId'], PDO::PARAM_STR);
      $ask->execute();
    }

    //Retun an array[] with groupID and group from sat.groups
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

    //Return an array[] with the roles and roleID from sat.role
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
      //return the array
      return $arr;
    }

}
 ?>
