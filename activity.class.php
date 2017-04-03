<?php
require_once 'jumper.inc.php';
//instance to create a new class named Activity
//$db variable gets passed along so it can be used inside the class
$objUser = new Activity($db);
class Activity {

//protected class variables, only to be used inside superclass and child classes
  protected $activity;
  protected $activityID;
  protected $type;
  protected $startDate;
  protected $endDate;
  protected $difficulty;
  protected $satisfaction;
  protected $notes;
  protected $db;

//constructor set in place to receive $db variable and set it as an internal class variable
public function __construct($db) {
    $this->db = $db;
  }
//below a list of functions to filter the input of the activity fields
//TODO: reviews public functions and set as private/protected
  public function filterActivity($newActivity) {
    $this->activity = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
  }
  public function getActivity() {
    return $this->activity;
  }
  public function filterType($newType) {
    $this->type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
}
  public function getType() {
    return $this->type;
}
  public function filterStartDate($newStartDate) {
    $this->startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_NUMBER_INT);
}
  public function getStartDate() {
    return $this->startDate;
}
  public function filterDifficulty($newDifficulty) {
    $this->difficulty = filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_INT);
}
  public function getDifficulty() {
    return $this->difficulty;
}
  public function filterSatisfaction($newSatisfaction) {
    $this->satisfaction = filter_input(INPUT_POST, 'satisfaction', FILTER_SANITIZE_NUMBER_INT);
}
  public function getSatisfaction() {
    return $this->satisfaction;
}

  public function filterNotes($newNotes) {
    $this->notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
}
  public function getNotes() {
    return $this->notes;
}
//function to view activities
  public function viewActivities() {
    $stmt = $this->db->query('SELECT * FROM sat.activity');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
//function to edit/update activities
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
//function to write the initial activity to the database
public function setActivity() {
    $stmt = "INSERT INTO sat.activity (
            activity,
            type,
            difficulty,
            satisfaction,
            notes
          ) VALUES (
            :activity,
            :type,
            :difficulty,
            :satisfaction,
            :notes)";
    $sql = $this->db->prepare($stmt);
    $sql->bindParam(':activity', $_POST['activity'], PDO::PARAM_STR);
    $sql->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
    // use PARAM_STR even though the input is a number
    $sql->bindParam(':difficulty', $_POST['difficulty'], PDO::PARAM_STR);
    $sql->bindParam(':satisfaction', $_POST['satisfaction'], PDO::PARAM_STR);
    $sql->bindParam(':notes', $_POST['notes'], PDO::PARAM_STR);
    $sql->execute();
}
//public function can be called outside the class
//private function can only be used inside the class

}
 ?>
