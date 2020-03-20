<?php

require_once(__DIR__ . '/../setting/setting.php');

$index = new MyApp\Controller\Top();

$index->begin();





?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ホーム画面</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <form action="logout.php" method="post" id="logout">
      <?= h($index->myMail()->email); ?><input type="submit" value="ログアウト">
      <input type="hidden" name="security" value="<?= h($_SESSION['security']); ?>">
    </form>
    <a href="/firstView/delete.php">アカウント削除画面に進む</a>
    <h1>ユーザー一覧<span class="user">(<?= count($index->getNums()->user); ?>)</span></h1>
    <ul>
      <?php foreach($index->getNums()->user as $email): ?>
      <li><?= $email['email']; ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>