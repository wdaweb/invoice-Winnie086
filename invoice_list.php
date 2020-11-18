<?php
include_once "base.php";

$period=ceil(date("m")/2);

$sql="select * from `invoice` where period='$period' order by date desc";

$rows=$pdo->query($sql)->fetchAll();


?>
<div class="row justify-content-around" style="list-style-type:none;paddin:0">
    <li><a href="http://">1,2月</a></li>
    <li><a href="http://">3,4月</a></li>
    <li><a href="http://">5,6月</a></li>
    <li><a href="http://">7,8月</a></li>
    <li><a href="http://">9,10月</a></li>
    <li><a href="http://">11,12月</a></li>
</div>


<table class="table text-center">
    <tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>

    <?php
    foreach($rows as $row){
    ?>
    
    <tr>
        <td><?=$row['code'].$row['number'];?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['payment'];?></td>
        <td>
            <button class="btn btn-sm btn-primary">
                <a href="?do=edit_invoice&id=<?=$row['id'];?>" class="text-white"> 編輯</a>
             </button>

             <button class="btn btn-sm btn-danger">
                <a class="text-white" href="?do=del_invoice&id=<?=$row['id'];?>">刪除
             </button>

             <button class="btn btn-sm btn-success">
                <a class="text-white" href="?do=award&id=<?=$row['id'];?>">對獎
             </button>
        </td>
    </tr>
    <?php
    }
    ?>
</table>