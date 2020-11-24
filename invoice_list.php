<?php
include_once "base.php";

$period=ceil(date("m")/2);

if(isset($_GET['period'])){

    $sql="select * from `invoice` where period='{$_GET['period']}' order by date desc";
    $rows=$pdo->query($sql)->fetchAll();
    
}else{

    foreach($rows as $row){
?>
    
    <tr>
        <td><?=$row['code']."-".$row['number'];?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['payment'];?></td>
        <td>
            <button class="btn btn-sm btn-dark">
                <a href="?do=edit_invoice&id=<?=$row['id'];?>" class="text-white"> 編輯</a>
             </button>

             <button class="btn btn-sm btn-danger">
                <a class="text-white" href="?do=del_invoice&id=<?=$row['id'];?>">刪除
             </button>

        </td>
    </tr>

    <?php
    }
    ?>

}

<div class="row justify-content-around" style="list-style-type:none;paddin:0">
    <li><a href="?do=invoice_list&period=1">1-2月</a></li>
    <li><a href="?do=invoice_list&period=2">3-4月</a></li>
    <li><a href="?do=invoice_list&period=3">5-6月</a></li>
    <li><a href="?do=invoice_list&period=4">7-8月</a></li>
    <li><a href="?do=invoice_list&period=5">9-10月</a></li>
    <li><a href="?do=invoice_list&period=6">11-12月</a></li>
</div>

<table class="table text-center">
    <tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>
</table>