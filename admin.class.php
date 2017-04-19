<?php
class Admin extends User {

  public function callUpdateRole() {
    $storage = new Storage($db);
    $update = $storage->updateRole();
  }

}
?>
