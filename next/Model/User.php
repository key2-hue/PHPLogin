<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
  public function create($num) {
    $stmt = $this->database->prepare("insert into loginUsers (email, password, created, modified,name) values (:email, :password, now(), now(), :nickname)");
    $result = $stmt->execute([
      ':email' => $num['email'],
      ':password' => password_hash($num['password'], PASSWORD_DEFAULT),
      ':nickname' => $num['nickname']
    ]);

    if($result === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }

    $signupInfo = $this->database->prepare("select * from loginUsers name = :name");
    $info = $signupInfo->execute([
      ':name' => $num['nickname']
    ]);

    return $info;
  }

  public function login($info) {
    $stmt = $this->database->prepare("select * from loginUsers where email = :email");
    $stmt->execute([
      ':email' => $info['email']
    ]);
    
    $loginUser = $stmt->fetch(\PDO::FETCH_ASSOC);


    // var_dump($loginUser);

    if(empty($loginUser)) {
      throw new \MyApp\Exception\WrongLogin();
    }

    if(!password_verify($info['password'], $loginUser['password'])) {
      throw new \MyApp\Exception\WrongLogin();
    }

    return $loginUser;

    
  }

  
}