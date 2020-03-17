<?php

ini_set('display_errors', 1);

define('DATABASE_USERNAME','dbuser');
define('DATABASE_PASSWORD','keymaeda2');
define('DATABASE_NAME','login_git_php');
define('DSN','mysql:dbhost=localhost;unix_socket=/tmp/mysql.sock;dbname='.DATABASE_NAME);
define('TOP_URL', 'http://' . $_SERVER['HTTP_HOST']);

session_start();

require_once(__DIR__ . '/../next/functions.php');
require_once('/autoload.php');
