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

}
 ?>
