<?php
require_once 'jumper.inc.php';
//$db variable gets passed along so it can be used inside the class
class Activity {

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

  public function postData() {
    $this->activityID = filter_input(INPUT_POST, 'activityID', FILTER_SANITIZE_NUMBER_INT);;
    $this->activity = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
    $this->type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
    $this->startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_NUMBER_INT);
    $this->difficulty = filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_INT);
    $this->satisfaction = filter_input(INPUT_POST, 'satisfaction', FILTER_SANITIZE_NUMBER_INT);
    $this->notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);
  }
}
 ?>
