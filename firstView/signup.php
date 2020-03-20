<?php

require_once(__DIR__ . '/../setting/setting.php');

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
      <fieldset>
        <legend>登録するメールアドレス及びパスワードを入力してください</legend>
        <div class="label">
          <label>メールアドレス
            <input type="text" name="email" value="<?= isset($signup->getNums()->email) ? h($signup->getNums()->email) : ''; ?>">
          </label>
          <p class="err"><?= h($signup->getMistakes('email')); ?></p>
          <label>パスワード
            <input type="password" name="password">
          </label>
        </div>
        <p class="err"><?= h($signup->getMistakes('password')); ?></p>
        <input type="submit" value="サインアップ" name="signup" class="btn">
      </fieldset>
      <p class="link"><a href="/firstView/login.php">ログイン</a></p>
      <input type="hidden" name="security" value="<?= h($_SESSION['security']); ?>">
    </form>
  </div>
</body>
</html>
