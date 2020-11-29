<?php
include_once "base.php";


if(isset($_GET['period'])){
    
    $period=$_GET['period'];
    
}else {
    
    $period=ceil(date("m")/2);
    
} 

if(isset($_GET['year'])){
    
    $year=$_GET['year'];
    
}else {
    
    $year=date("Y");
    
} 


$sql="select * from `invoice` where period='$period' order by date desc ";
$rows=$pdo->query($sql)->fetchAll();


?>


    <div class="row justify-content-around align-items-center">
    <form class="d-flex" action="?do=invoice_list" method="$_GET">
    <div class="col-6"><input type="number" placeholder="請輸入去/今年" name="year" style="width:170px" min="<?=$year-1;?>" max="<?=$year;?>" step="1" value="<?=date("Y");?>"></div>
    <div class="col-6"><input type="submit" style="width:150px" class="btn btn-dark" value="查詢"></div>
    </form>
    </div>

    <!-- <div class="row justify-content-center align-items-center">
        <a href="?year=<?=$year-1;?>" class="col-6"><i class="fas fa-angle-double-left"></i></a>
        <a href="?year=<?=$year;?>" class="col-6"><i class="fas fa-angle-double-right"></i></a>
    </div> -->

    <div class="row justify-content-around" style="list-style-type:none;paddin:0">
    <li><a href="?do=invoice_list&period=1">1-2月</a></li>
    <li><a href="?do=invoice_list&period=2">3-4月</a></li>
    <li><a href="?do=invoice_list&period=3">5-6月</a></li>
    <li><a href="?do=invoice_list&period=4">7-8月</a></li>
    <li><a href="?do=invoice_list&period=5">9-10月</a></li>
    <li><a href="?do=invoice_list&period=6">11-12月</a></li>
    <!-- <li><a href="?do=invoice_list&year=<?=$year;?>&period=6">11-12月</a></li> -->
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


