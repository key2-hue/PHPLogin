<?php


namespace MyApp\Controller;

// require_once('login_git_php/next/Controller.php');


class Signup extends \MyApp\Controller {

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
      $this->setMistakes('email', $e->getMessage());
    } catch(\MyApp\Exception\InvalidPassword $e) {
      $this->setMistakes('password', $e->getMessage());
    }

    $this->setNums('email', $_POST['email']);

    if($this->hasError()) {
      return;
    } else {
      try {
        $model = new \MyApp\Model\User();
        $model->create([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      } catch(\MyApp\Exception\DuplicateEmail $e) {
        $this->setMistakes('email', $e->getMessage());
        return;
      }
      header('Location: ' . TOP_URL . '/firstView/signup.php');
      exit;
    }
  }

  private function check() {

    if(!isset($_POST['security']) || $_POST['security'] !== $_SESSION['security']) {
      echo "セキュリティーにミスがあります";
      exit;
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }
    if(!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \MyApp\Exception\InvalidPassword();
    }
  }
}