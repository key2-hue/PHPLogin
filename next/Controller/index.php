<?php

namespace MyApp\Controller;

class Top extends \MyApp\Controller {
  public function begin() {
    if(!$this->afterLogin()) {
      header('Location: ' . TOP_URL . '/login.php');
    }
  }
}