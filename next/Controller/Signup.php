<?php

namespace MyApp\Controller;

class SignUp extends \MyApp\Controller {
  public function begin() {
    if($this->afterLogin()) {
      header('Location: ' . TOP_URL);
      exit;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->loginFlow();
    }
  }

  protected function loginFlow() {
    try {
      $this->check();
    } catch(\MyApp\Exception\InvalidEmail $e) {

    } catch(\MyApp\Exception\InvalidPassword $e) {

    }
  }

  private function check() {
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }
    if(!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \MyApp\Exception\InvalidPassword();
    }
  }
}