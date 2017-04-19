<?php
class Admin extends User {

  public function callUpdateRole($db) {
    $storage = new Storage($db);
    $update = $storage->updateRole();
  }
  public function removeUser() {

  }
}
?>
