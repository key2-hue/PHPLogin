<?php

require_once(__DIR__ . '/../setting/setting.php');

$signup = new MyApp\Controller\Signup();

$signup->begin();

// var_dump($_POST['nickname']);

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
    <p><?= isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?></p>
    <form action="" method="post" id="Signup">
      <fieldset>
        <legend>登録するメールアドレス及びパスワードを入力してください</legend>
        <div class="labelSign">
          <label>ニックネーム
            <input type="text" name="nickname" value="">
          </label>
          <p class="err"><?= $signup->wrongNickname; ?></p>
          <label>メールアドレス
            <input type="text" name="email" value="<?= isset($signup->getNums()->email) ? h($signup->getNums()->email) : ''; ?>">
          </label>
          <p class="err"><?= $signup->wrongEmail; ?></p>
          <label>パスワード
            <input type="password" name="password">
          </label>
        </div>
        <p class="err"><?= $signup->wrongPassword; ?></p>
        <input type="submit" value="サインアップ" name="signup" class="btn">
      </fieldset>
      <p class="link"><a href="/firstView/login.php">ログイン</a></p>
      <input type="hidden" name="security" value="<?= h($_SESSION['security']); ?>">
    </form>
  </div>
</body>
</html>
