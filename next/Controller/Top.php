<?php

namespace MyApp\Controller;

class Top extends \MyApp\Controller {
  public function begin() {
    $allUser = $this->AllUser();
    
    $this->setNums('user', $allUser);
    if(!$this->afterLogin()) {
      header('Location: ' . TOP_URL . '/firstView/login.php');
    }
  }
}