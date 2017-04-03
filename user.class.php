<?php
//instance to create a new class named User
$objUser = new User;
class User {
  //class variable, set to public for it to be used outside the class
  public $firstName;
  public $lastName;
  public $email;
  public $pass;
  public $state;
  public $token;
  public $userName;

//protected class variables, only to be used inside superclass and child classes
  protected $activity = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_STRING);
  protected $activityID = filter_input(INPUT_POST, 'activityID', FILTER_SANITIZE_NUMBER_FLOAT);
  protected $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING);
  protected $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_NUMBER_INT);
  protected $endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_NUMBER_INT);
  protected $difficulty = filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_INT);
  protected $satisfaction = filter_input(INPUT_POST, 'satisfaction', FILTER_SANITIZE_NUMBER_INT);
  protected $notes = filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING);

  protected function viewActivities {
    $stmt = $db->query('SELECT * FROM sat.activity');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
//public function can be called outside the class
//private function can only be used inside the class

class Student extends User {
  }
}
 ?>
