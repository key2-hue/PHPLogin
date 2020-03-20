<?php

require_once(__DIR__ . '/../setting/setting.php');

$login = new MyApp\Controller\Login();
$login->begin();

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>ログイン機能</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <div id="container">
      <form action="" method="post" id="login">
        <fieldset>
          <legend>登録しているメールアドレス及びパスワードを入力してください</legend>      
            <div class="label">
            <label>メールアドレス
              <input type="text" name="email" value="<?= isset($login->getNums()->email) ? h($login->getNums()->email) : ''; ?>">
            </label> 
            <label>パスワード
              <input type="password" name="password">
            </label>
            </div>
          <p class="err"><?= h($login->getMistakes('login')); ?></p>
          <div class="btn" onclick="document.getElementById('login').submit();">ログイン</div>
          </fieldset>
          <p class="link"><a href="/firstView/signup.php">サインアップ</a></p>
          <input type="hidden" name="security" value="<?= h($_SESSION['security']); ?>">
      </form>
    </div>
  </body>
</html>