<?php
    //資料庫連結
    include_once "base.php";
    $sql = "SELECT * FROM `invoice` ORDER BY `date` desc";
    $result = $pdo->query($sql)->fetch();


    // $data_nums = mysql_num_rows($result); //統計總筆數
    $data_nums=$pdo->query($sql)->fetchAll();
    /**
    *妳網路找到的寫法是用舊的語法做的，mysqli_num_rows()的目的是回傳資料的筆數，是一個數字
    *但是$data_nums使用fetchAll()回傳的是一個資料集，不是數字，所以下面在算分配時
    *才會因為除法中放了不是數字的內容所傳出資料型態錯誤的訊息
    *解決的方式有兩個，一個是去計算$data_nums裏有多少筆資料，
    *可以用count($data_nums)來得到資料筆數
    *另一個方式是用PDO自己有的函式來計算
    *使用$data_nums->columnCount()也可以得到資料的筆數
    *兩個方法的結果都是一樣的
    */
    $per = 10; //每頁顯示項目數量
    $pages = ceil($data_nums/$per); //無條件進入法
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
    $start = ($page-1)*$per; //每一頁開始的資料序號
    
    /***
     * 這邊會再錯一次，因為我們沒有教mysql_query系列的函式
     * 要改用$pdo->query()->fetcAll()
     */
    $result = mysql_query($sql.' LIMIT '.$start.', '.$per,$conn) or die("Error");
?>

<table>
<tr>
        <td>發票號碼</td>
        <td>消費日期</td>
        <td>消費金額</td>
        <td>操作</td>
</tr>
<?php
//輸出資料內容
/**
 * 這邊還是會錯，因為我們沒有教mysql_fetch系列的語法
 * 請改成$pdo->query()->fetch()
 * while()的寫法很舊了，妳找的做法的網頁都六年前了，
 * 請改用foreach的方式來撈出資料
 */
while ($row = mysql_fetch_array ($result)){
    
    $code=$row['code'];
    $number=$row['number'];
    $date=$row['date'];
    $payment=$row['payment'];
    ?>
    
    <tr class="text-align:center;">
        <td><?php echo $code; ?></td>
        <td><?php echo $number;?></td>
        <td><?php echo $date;?></td>
        <td><?php echo $payment;?></td>
    </tr>

<?php 
    }
?>
</table>

<br />

<?php
    //分頁頁碼
    
    /**
     * $data_nums不是數字,所以這邊要echo $data_nums時會有錯誤
     */
    echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
?>