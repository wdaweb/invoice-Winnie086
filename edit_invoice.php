編輯發票

<?php
include_once "base.php";

$_GET['id'];
$sql="select * from `invoice` where id='{$_GET['id']}'";
$inv=$pdo->query($sql)->fetch();
echo "<pre>";
  print_r($inv);
echo "</pre>";
?>