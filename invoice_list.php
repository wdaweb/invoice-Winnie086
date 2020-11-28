<?php
include_once "base.php";


if(isset($_GET['pd'])){
    
    $year=explode("-",$_GET['pd'])[0];
    $period=explode("-",$_GET['pd'])[1];
    $rows=$pdo->query("select * from `invoice` where period='$period' order by date desc")->fetchAll();
    
}else {
    
    $nowperiod=ceil(date("m")/2);
    $rows=$pdo->query("select * from `invoice` where period='$nowperiod' order by date desc")->fetchAll();
    
} 

?>


    <div class="row">
    <form class="d-flex justify-content-center align-items-center" action="?do=invoice_list.php" method="$_GET">
    <div class="col-6"><input type="number" placeholder="請輸入去/今年" name="year" style="width:170px" min="<?=date("Y")-1;?>" max="<?=date("Y");?>" step="1" value="<?=date("Y");?>"></div>
    <div class="col-6"><input type="submit" style="width:150px" class="btn btn-dark" value="查詢"></div>
    </form>
    </div>



    <div class="row justify-content-around" style="list-style-type:none;paddin:0">
    <li><a href="?do=invoice_list&year=<?=$Year;?>&pd=<?=$_GET['pd'];?>">1-2月</a></li>
    <li><a href="?do=invoice_list&pd=2020-2">3-4月</a></li>
    <li><a href="?do=invoice_list&pd=2020-3">5-6月</a></li>
    <li><a href="?do=invoice_list&pd=2020-4">7-8月</a></li>
    <li><a href="?do=invoice_list&pd=2020-5">9-10月</a></li>
    <li><a href="?do=invoice_list&pd=2020-6">11-12月</a></li>
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

</table>


