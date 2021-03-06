<?php
//Database connection
require_once 'config.inc.php';

try {
  $db = new PDO("mysql:host=$server;dbname=$dbname", $user, $pass);
  //Set PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo 'Database connection error: ' . $e->getMessage() . '<br>';
  die();
}

//Close connection
//$db = null;

//Add a new user
function addUser(&$db, $user, $token) {
  $sql = " INSERT INTO sat.users
  (sat.users.userName, sat.users.passCode, sat.users.firstName, sat.users.lastName,
    sat.users.email, sat.users.role, sat.users.token)
    VALUES
    (:userName, :passCode, :firstName, :lastName, :email, :role, :token)";
  $ask = $db->prepare($sql);
  $ask->bindValue(':userName', $user['userName'], PDO::PARAM_STR);
  $ask->bindValue(':passCode', $user['passCode'], PDO::PARAM_STR);
  $ask->bindValue(':firstName', $user['firstName'], PDO::PARAM_STR);
  $ask->bindValue(':lastName', $user['lastName'], PDO::PARAM_STR);
  $ask->bindValue(':email', $user['email'], PDO::PARAM_STR);
  $ask->bindValue(':role', 'registered', PDO::PARAM_STR);
  $ask->bindValue(':token', $token, PDO::PARAM_STR);
  $ask->execute();
  //TODO try/catch with PDOException
}

//Return token from database matching userName
function retToken(&$db, $userName) {
  $sql = "SELECT token FROM sat.users WHERE userName = :user";
  $ask = $db->prepare($sql);
  $ask->bindValue(':user', $userName, PDO::PARAM_STR);
  $ask->execute();
  return $ask->fetchColumn();
}

//Remove token from database when token matches
function changeToken(&$db, $userName) {
  $sql = "UPDATE users SET token = '' WHERE userName = :name";
  $ask = $db->prepare($sql);
  $ask->bindValue(':name', $userName, PDO::PARAM_STR);
  $ask->execute();
}

//Change userstate in database
function changeToRegistered(&$db, $userName) {
  $sql = "UPDATE users SET role = 'REG' WHERE userName = :name";
  $ask = $db->prepare($sql);
  $ask->bindValue(':name', $userName, PDO::PARAM_STR);
  $ask->execute();
}

//Check if username is already in the database
function checkUsernameExist(&$db, $search) {
    $sql = "SELECT userName FROM sat.users WHERE userName = :search";
    $ask = $db->prepare($sql);
    $ask->bindValue(':search', $search, PDO::PARAM_STR);
    $ask->execute();
    return $ask->fetchAll(PDO::FETCH_ASSOC);
}

//Check if the emailadres is already in the database
function checkEmailExist(&$db, $search) {
  $sql = "SELECT email FROM sat.users WHERE email = :search";
  $ask = $db->prepare($sql);
  $ask->bindValue(':search', $search, PDO::PARAM_STR);
  $ask->execute();
  return $ask->fetchAll(PDO::FETCH_ASSOC);
}

//show all roles
function showAllRoles(&$db) {
  $sql = "SELECT * FROM sat.role";
  $ask = $db->prepare($sql);
  $ask->execute();
  return $ask->fetchAll(PDO::FETCH_COLUMN);
}

//Retrieve passCode belonging to user
function logUser(&$db, $user) {
  $sql = "SELECT passCode FROM sat.users WHERE userName = :user";
  $ask = $db->prepare($sql);
  $ask->bindValue(':user', $user, PDO::PARAM_STR);
  $ask->execute();
  return $ask->fetchColumn();
}

//Get all user stuff from database as a object
function getUser(&$db, $user) {
  $sql = "SELECT userName, userID, firstName, lastName, email, groupID, role, state
          FROM sat.users
          WHERE userName = :user";
  $ask = $db->prepare($sql);
  $ask->bindValue(':user', $user, PDO::PARAM_STR);
  $ask->execute();
  return $ask->fetchObject();
}
?>
