<?php

namespace MyApp\Exception;

class Wronglogin extends \Exception {
  protected $message = 'Eメールとパスワードが一致していません';
}