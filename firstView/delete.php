<?php

require_once(__DIR__ . '/../setting/setting.php');

$index = new MyApp\Controller\Top();
$delete = new MyApp\Controller\Delete();
$deleteUser = $index->myMail()->email;
$delete->begin($deleteUser);

?>


<form action="delete.php" method="post" id="deleteUser">
  <input type="submit" value="アカウントの削除">
</form>