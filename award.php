<?php
include_once "base.php";

$inv_id=$_GET['id'];

// echo "select * from invoice where id='$inv_id'";
$invoice=$pdo->query("select * from invoice where id='$inv_id'")->fetch();
// fetch()一筆資料、fetchAll()多筆資料

// echo "<pre>";
// print_r($invoice);
// echo "</pre>";
$number=$invoice['number'];

// 找出獎號
// 1. 確認期數:目前發票的日期作分析
// 2. 得到期數資料後:對應該期開獎獎號

$date=$invoice['date'];

// explode('-',$date)取得日期資料的陣列，陣列第二個元素就是月份
// 月份可推算期數，有期數及年份就可找到該期開獎號碼
// $array=explode('-',$date);
// $month=$array[1];
// $period=ceil(explode($month/2);

$period=ceil(explode('-',$date)[1]/2);
echo "select * from award_numbers where year='$year' && period='$period'";
$awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();


?>