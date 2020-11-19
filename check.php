<?php
session_start();

$_SESSION['err']=[];

$acc=$_POST['acc'];

accept('acc');
/* if(empty($acc)){
    $_SESSION['err']['acc']['empty']=true;
} */
length('acc',4,10);
/* if(strlen($acc)>10 || strlen($acc) < 4){
    $_SESSION['err']['acc']['len']=true;
} */


$pw=$_POST['pw'];
accept('pw');
/* if(empty($pw)){
    $_SESSION['err']['pw']['empty']=true;
}
 */
length('pw',8,16);
/* if(strlen($pw)>16 || strlen($pw) < 8){
    $_SESSION['err']['pw']['len']=true;
} */

$name=$_POST['name'];
$birthday=$_POST['birthday'];
$addr=$_POST['addr'];
$tel=$_POST['tel'];
$email=$_POST['email'];




//欄位都檢查完畢;
if(empty($_SESSION['err'])){
    $sql="inset,update,delete,select";
    echo '欄位均符合規範！';
    //$pdo->exec($sql);
}

header("location:index.php");

function accept($field){
    if(empty($_POST[$field])){
        $_SESSION['err'][$field]['empty']=true;
    }
}

function length($field,$min,$max){
    if(strlen($_POST[$field])>$max || strlen($_POST[$field]) < $min){
        $_SESSION['err'][$field]['len']=true;
    }
    
}

?>