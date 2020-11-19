<?php
include_once "base.php";

$period_str=[
  1=>'1,2月',
  2=>'3,4月',
  3=>'5,6月',
  4=>'7,8月',
  5=>'9,10月',
  6=>'11,12月'
];


echo "你要對的發票是".$_GET['year']."年";
echo $period_str[$_GET['period']]."的發票";

// 撈出該期發票
$sql="select * from invoice where period='{$_GET['period']}' && left(date,4)='{$_GET['year']}' Order by date desc";
echo $sql;
$invoice=$pdo->query($sql)->fetchAll();
echo count($invoice);

// echo "<pre>";
// print_r($invoice);
// echo "</pre>";


// 撈出對獎號碼
$sql="select * from award_numbers where year='{$_GET['year']}' && period='{$_GET['period']}'";
$award_numbers=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($award_numbers);
echo "</pre>";














?>