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
?>


    <div class="row justify-content-around align-items-center">
    <form class="d-flex" action="?do=invoice_list" method="$_GET">
    <div class="col-6"><input type="number" placeholder="請輸入去/今年" name="year" style="width:170px" min="<?=$year-1;?>" max="<?=$year;?>" step="1" value="<?=date("Y");?>"></div>
    <div class="col-6"><input type="submit" style="width:150px" class="btn btn-dark" value="查詢"></div>
    </form>
    </div>


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
        <td>編號</td>
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
        
        <td></td>
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


<div class="container row justify-content-center">
<?php
    //分頁頁碼
    echo "<div class='col-12'>";
    echo '共 '.$data_nums[0].' 筆-現在在第 '.$page.' 頁-共 '.$pages.' 頁';
    echo "</div>";
    
    
    echo "<div class='col-12'>";
    echo "<br><a href=?page=1>首頁</a> ";
    echo "第";
    for( $i=1 ; $i<=$pages ; $i++ ){
        if ( $page-3 < $i && $i < $page+3 ){
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
    echo "</div>";
?>
</div>