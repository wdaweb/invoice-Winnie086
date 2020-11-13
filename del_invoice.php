<?php

include_once "base.php";

$inv=$pdo->query("select * from invoice where id='{$_GET['id']}'")->fetch();

  ?>

<div class="col-md-6 text-center border p-4 mx-auto">
    <div class="text-center">真的要刪發票資料嗎?</div>
    <ul class="list-group">
      <li class="list-group-item"><?=$inv['code'].$inv['number'];?></li>
      <li class="list-group-item"><?=$inv['date'];?></li>
      <li class="list-group-item"><?=$inv['payment'];?></li>
    </ul>    
    
    <div class="text-center mt-4">
      <button class="btn-danger">
      <a href="api/del.php?id=<?=$_GET['id'];?>">確認</a>
      </button>
      
      <button class="btn-warning">
      <a href="?do=invoice_list">取消</a>
      </button>
    </div>
    
</div>




