<?php
//instance to create a new class named User
class Test {
  //class variable, set to public for it to be used outside the class
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
  public $insert;

  public function __construct($db) {

    $this->db = $db;
    //user stuff pulled from db on correct login
    $this->userName = 'Puk van de Petterflet';
    $this->insert = filter_input(INPUT_POST, 'insert', FILTER_SANITIZE_STRING);
  }

  public function showField() {
    echo 'Test: ';
    echo $this->insert;
  }
public function getActivity() {
  $this->activity = $_POST['activity'];
  $this->activityID = $_POST['activityID'];
  $this->type = $_POST['type'];
  $this->startDate = $_POST['startDate'];
  $this->difficulty = $_POST['difficulty'];
  $this->satisfaction = $_POST['satisfaction'];
  $this->notes = $_POST['notes'];
}
//protected class variables, only to be used inside superclass and child classes
//public function can be called outside the class
//private function can only be used inside the class
public function setActivity() {
  $this->getActivity();
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
  $sql->bindParam(':activity', $this->activity, PDO::PARAM_STR);
  $sql->bindParam(':type', $this->type, PDO::PARAM_STR);
  $sql->bindParam(':startDate', $this->startDate, PDO::PARAM_STR);
  // use PARAM_STR even though the input is a number
  $sql->bindParam(':difficulty', $this->difficulty, PDO::PARAM_INT);
  $sql->bindParam(':satisfaction', $this->satisfaction, PDO::PARAM_INT);
  $sql->bindParam(':notes', $this->notes, PDO::PARAM_STR);
  $sql->execute();
  }
}

class Bike extends Test {
    //student functionality



//test function to be removed on final version
  public function testPedals() {
    echo "<p>Knoink rusty chain</p>";
  }
}

class Car extends Test {
  //test function
  public function testEngine() {
    echo '<p><code>Brrrrrrrrrrrr V8</code></p>';
  }
}

class Spaceship extends Test {
  //test functin private
  private function testFly($space) {
    echo '<h1>We are flying high '. $space. '!</h1>';
  }

  public function sayTestFly($space) {
    $this->testFly($space);
  private function testFly($ship) {
    echo '<h1>We are flying high!</h1><p>I love my ' . $ship . '</p>';
  }

  public function sayTestFly($ship) {
    $this->testFly($ship);
  }
}
 ?>
