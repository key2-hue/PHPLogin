<?php

require_once(__DIR__ . '/../setting/setting.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(!isset($_POST['security']) || $_POST['security'] !== $_SESSION['security']) {
    echo 'セキュリティーに問題があります';
    exit;
  }
  $_SESSION = [];

  if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 86400, '/');
  }

  session_destroy();
}

header('Location: ' . TOP_URL . '/firstView/login.php');