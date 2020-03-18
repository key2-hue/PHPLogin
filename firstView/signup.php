<?php

require_once(__DIR__ . '/../setting/setting.php');

// require_once(__DIR__ . '/../next/Controller/Signup.php');

$signup = new MyApp\Controller\Signup();

$signup->begin();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン画面</title> 
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="" method="post" id="Signup">
      <p>
        <input type="text" name="email" placeholder="メールアドレス">
      </p>
      <p class="err"><?= h($signup->getErrors('email')); ?></p>
      <p>
        <input type="password" name="password" placeholder="パスワード">
      </p>
      <p class="err"><?= h($signup->getErrors('password')); ?></p>
      <div class="btn" onclick="document.getElementById('signup').submit();">サインアップ</div>
      <p class="link"><a href="/login.php">サインアップ</a></p>
    </form>
  </div>
</body>
</html>
