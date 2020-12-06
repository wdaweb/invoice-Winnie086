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
// print_r($rows);

$data_nums=$pdo->query("select count(`invoice`.`id`) from `invoice` where year(`date`)='$year' && `period`='$period'")->fetch();
$per = 20; //每頁顯示項目數量
$pages = ceil($data_nums[0]/$per); //無條件進入法，算總共需要幾頁
if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
    $page=1; //剛開始進來，則在此設定起始頁數
}else {
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料，顯示現在在第幾頁
}
$start = ($page-1)*$per; //每一頁開始的資料序號，資料庫中的排法跟陣列一樣，索引值從第0筆開始
$result=$pdo->query($sql.' LIMIT '.$start.','.$per)->fetchAll();//LIMIT函式:$start顯示每頁開始的索引值、$per代表每頁要顯示幾筆資料
// print_r($result);

if(isset($_GET['page'])){
    $thisPage=$_GET['page'];
}else{
    $thisPage=1;
}

// 分頁-上一頁的連結
if(($thisPage-1)<=0){
    $lastPage=1;
}else{
    $lastPage=$thisPage-1;
}

// 分頁-下一頁的連結
if(($thisPage+1)>=$pages){
    $nextPage=$pages;
}else{
    $nextPage=$thisPage+1;
}


?>




    <div class="row justify-content-around" style="list-style-type:none;paddin:0">
    <li><a href="?do=invoice_list&year=<?=$year;?>&period=1">1-2月</a></li>
    <li><a href="?do=invoice_list&year=<?=$year;?>&period=2">3-4月</a></li>
    <li><a href="?do=invoice_list&year=<?=$year;?>&period=3">5-6月</a></li>
    <li><a href="?do=invoice_list&year=<?=$year;?>&period=4">7-8月</a></li>
    <li><a href="?do=invoice_list&year=<?=$year;?>&period=5">9-10月</a></li>
    <li><a href="?do=invoice_list&year=<?=$year;?>&period=6">11-12月</a></li>
    </div>

<br>

    <ul class="pagination justify-content-center">
    <li>現在在第<span style="color:red"><?=$page;?></span>頁</li>
    </ul>



<table class="table text-center">
    <tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
    </tr>

    <?php
    foreach($result as $row){
    
        $code=$row['code']."-".$row['number'];
        $date=$row['date'];
        $payment=$row['payment'];
        ?>
        
        <td><?php echo $code; ?></td>    
        <td><?php echo $date;?></td>
        <td><?php echo $payment;?></td>
         
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

<ul class="pagination justify-content-center">
    <li>共<?=$data_nums[0];?>筆-現在在第<span style="color:red"><?=$page;?></span>頁-共<?=$pages;?>頁</li>
    </ul>


<nav>
  <ul class="pagination justify-content-center">

  <li class="page-item"><a class="btn btn-md btn-dark" href="?do=invoice_list&year=<?=$year;?>&period=<?=$period;?>&page=1">首頁</a></li>

    <li class="page-item">
      <a class="page-link" href="?do=invoice_list&year=<?=$year;?>&period=<?=$period;?>&page=<?=$lastPage;?>" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
    </li>

    <p>第</p>
    <?php
    for( $i=1 ; $i<=$pages ; $i++ ){
        if ( $page-4 < $i && $i < $page+4 ){
            echo "<li class='page-item'><a class='page-link' href=?do=invoice_list&year=$year&period=$period&page=$i>".$i."</a></li>";
        }
    } 
    ?>
    <p>頁</p>

    <li class="page-item">
      <a class="page-link" href="?do=invoice_list&year=<?=$year;?>&period=<?=$period;?>&page=<?=$nextPage;?>"><i class="fas fa-angle-double-right"></i></a>
    </li>

    <li class="page-item"><a class="btn btn-md btn-dark" href="?do=invoice_list&year=<?=$year;?>&period=<?=$period;?>&page=<?=$pages;?>">末頁</a></li>
  </ul>
</nav>
