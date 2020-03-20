<?php

namespace MyApp;



class Controller {
  private $mistake;
  private $nums;
  private $database;
  public function __construct() {
    if(!isset($_SESSION['security'])) {
      $_SESSION['security'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
    $this->mistake = new \stdClass();
    $this->nums = new \stdClass();
    $this->database = new \PDO(DSN, DATABASE_USERNAME, DATABASE_PASSWORD);
  }
  protected function afterLogin() {
    return isset($_SESSION['currentUser']) && !empty($_SESSION['currentUser']);
  }

  protected function setMistakes($point, $miss) {
    $this->mistake->$point = $miss;
  }

  public function getMistakes($point) {
    return isset($this->mistake->$point) ? $this->mistake->$point : '';
  }

  protected function hasError() {
    return !empty(get_object_vars($this->mistake));
  }

  protected function setNums($point, $num) {
    $this->nums->$point = $num;
  }

  public function getNums() {
    return $this->nums;
  }

  public function myMail() {
    return $this->afterLogin() ? $_SESSION['currentUser'] : null;
  }

  public function AllUser() {
    $users = $this->database->query("select email from loginusers");
    $allUser = $users->fetchAll();
    return $allUser;
  }

  public function deleteUser($deleteUser) {
    $sql = "delete from loginUsers where email = :email";
    $stmt = $this->database->prepare($sql);
    $stmt->bindParam(':email',$deleteUser);
    $stmt->execute();
  }
}