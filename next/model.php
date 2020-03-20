<?php

namespace MyApp;

class Model {
  protected $database;

  public function __construct() {
    try {
      $this->database = new \PDO(DSN, DATABASE_USERNAME, DATABASE_PASSWORD);
    } catch(\PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  }
}