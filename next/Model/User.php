<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
  public function create($num) {
    $stmt = $this->database->prepare("insert into loginUsers (email, password, created, modified) values (:email, :password, now(), now())");
    $result = $stmt->execute([
      ':email' => $num['email'],
      ':password' => password_hash($num['password'], PASSWORD_DEFAULT)
    ]);

    if($result === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }

  public function login($num) {
    $stmt = $this->database->prepare("select * from loginUsers where email = :email");
    $stmt->execute([
      ':email' => $num['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $loginUser = $stmt->fetch();


    if(empty($loginUser)) {
      throw new \MyApp\Exception\WrongLogin();
    }

    if(!password_verify($num['password'], $loginUser->password)) {
      throw new \MyApp\Exception\WrongLogin();
    }

    return $loginUser;

    
  }

  
}