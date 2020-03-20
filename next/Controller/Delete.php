<?php

namespace MyApp\Controller;

class Delete extends \MyApp\Controller {
  public function begin($deleteUser) {
    $this->deleteUser($deleteUser);
  }
  
}

header('Location: '  . TOP_URL . '/firstView/signup.php');