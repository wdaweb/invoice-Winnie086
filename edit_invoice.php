<?php
include_once "base.php";


$sql="select * from invoice where id='{$_GET['id']}'";
$inv=$pdo->query($sql)->fetch();
// echo "<pre>";
//   print_r($inv);
// echo "</pre>";
?>

<form action="api/update_invoice.php" method="post">
  <input type="hidden" name="id" value="<?=$inv['id'];?>">
  <div>發票號碼
      <input type="text" name="code" style="width:35px" value="<?=$inv['code'];?>">
      <input type="number" name="number" value="<?=$inv['number'];?>"></div>
  
      <div>消費日期<input type="date" name="date" value="<?=$inv['date'];?>"></div>
      <div>消費金額<input type="text" name="payment" value="<?=$inv['payment'];?>"></div>
  
  <div>
  <input type="submit" value="修改" class="btn btn-sm btn-primary">
  <input type="reset" value="重置" class="btn btn-sm btn-dark">
  </div>
  
</form>
</form>