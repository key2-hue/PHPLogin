<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller {
  public function begin() {
    if($this->afterLogin()) {
      header('Location: ' . SITE_URL);
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['login'])) {
        $this->loginFlow();
      }
    }
  }

  protected function loginFlow() {
    try {
      $this->check();
    } catch (\MyApp\Exception\NotLogin $e) {
      $this->setMistakes('login', $e->getMessage());
    }

    $this->setNums('email', $_POST['email']);
    if($this->hasError()) {
      return;
    } else {
      try {
        $loginOrigin = new \MyApp\Model\User();
        $login = $loginOrigin->login([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      } catch(\MyApp\Exception\WrongLogin $e) {
        $this->setMistakes('login', $e->getMessage());
        return;
      }

      session_regenerate_id(true);
      $_SESSION['currentUser'] = $login;

      header('Location: ' . TOP_URL . '/firstView/index.php');
      exit;
    }
  }

  private function check() {
    if(!isset($_POST['security']) || $_POST['security'] !== $_SESSION['security']) {
      echo "セキュリティーにミスがあります";
      exit;
    }

    if(!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "メールアドレスもしくはパスワードが設定されていません";
      exit;
    }

    if($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \MyApp\Exception\NotLogin();
    }
  }
}