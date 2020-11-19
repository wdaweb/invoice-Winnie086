<?php
session_start();

$_SESSION['err']=[];



accept('acc','帳號欄位不得為空');
length('acc',4,10,'帳號長度應在4~10字元之間');

accept('pw');
length('pw',8,16);

accept('name','姓名欄位不得為空');
length('name',1,8);

accept('email');
email('email','email格式錯誤');

$birthday=$_POST['birthday'];
$addr=$_POST['addr'];
$tel=$_POST['tel'];




//欄位都檢查完畢;
if(empty($_SESSION['err'])){
    $sql="inset,update,delete,select";
    echo '欄位均符合規範！';
    //$pdo->exec($sql);
}

header("location:index.php");



function accept($field,$meg='此欄位不得為空'){
    if(empty($_POST[$field])){
        $_SESSION['err'][$field]['empty']=$meg;
    }
}

function length($field,$min,$max,$meg="長度不足"){
    if(strlen($_POST[$field])>$max || strlen($_POST[$field]) < $min){
        $_SESSION['err'][$field]['len']=$meg;
    }
    
}

function email($field,$meg='email格式錯誤'){
    $email=$_POST[$field];
    echo mb_strpos($email,'@');
    if(mb_strpos($email,'@')==false){
        $_SESSION['err'][$field]['email']=$meg;
    }
}
?>