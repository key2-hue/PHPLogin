<?php


namespace MyApp\Controller;

// require_once('login_git_php/next/Controller.php');


class Signup extends \MyApp\Controller {

  public $wrongEmail;
  public $wrongPassword;
  public $wrongNickname;
  public $signupUser;

  public function begin() {
    if($this->afterLogin()) {
      header('Location: ' . TOP_URL . '/firstView/index.php');
      exit;
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['signup'])) {
        $this->loginFlow();
      }
    }
  }

  protected function loginFlow() {
    try {
      $this->check();
    } catch(\MyApp\Exception\InvalidEmail $e) {
      $this->wrongEmail = "無効なメールアドレスです";
    } catch(\MyApp\Exception\InvalidPassword $e) {
      $this->wrongPassword = "無効なパスワードです";
    } 


    $this->setNums('email', $_POST['email']);
    $this->setNums('nickname', $_POST['nickname']);

    if($this->hasError()) {
      return;
    } else {
      try {
        $model = new \MyApp\Model\User();
        $model->create([
          'email' => $_POST['email'],
          'password' => $_POST['password'],
          'nickname' => $_POST['nickname']
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

    if(!preg_match("/^[ぁ-んァ-ヶーa-zA-Z0-9一-龠０-９]+$/u", $_POST['nickname'])) {
      $this->wrongNickname = "無効なニックネームです";
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }
    if(!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \MyApp\Exception\InvalidPassword();
    }
  }
}