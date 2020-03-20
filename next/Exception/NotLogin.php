<?php

namespace MyApp\Exception;

class NotLogin extends \Exception {
  protected $message = 'メールアドレス・パスワードを入力してください';
}