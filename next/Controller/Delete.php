<?php

namespace MyApp\Controller;

class Delete extends \MyApp\Controller {
  public function begin($deleteUser) {
    $this->deleteUser($deleteUser);
    $_SESSION = [];

    if(isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 86400, '/');
    }

    session_destroy();
  }
  
}

header('Location: '  . TOP_URL . '/firstView/signup.php');