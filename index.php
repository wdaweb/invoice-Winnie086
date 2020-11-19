<?php session_start() ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width, initial-scale=1.0">
    <title>資料檢查</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <form action="check.php" method="post">
        <ul class="list-group col-md-6 mx-auto">
        <li class="list-group-item">
            *帳號:<input type="text" name='acc'><br>
            <?php if(!empty($_SESSION['err']) && isset($_SESSION['err']['acc']['empty'])){  ;?>
            <span style="color:red;font-size:12px">帳號欄位不得為空</span>
            <?php } ;?>
            <?php if(!empty($_SESSION['err']) && isset($_SESSION['err']['acc']['len'])){  ;?>
            <span style="color:red;font-size:12px">欄位長度不符(4~10)</span>
            <?php } ;?>
        </li>
        <li class="list-group-item">*密碼:<input type="password" name='pw'><br>
        <?php if(!empty($_SESSION['err']) && isset($_SESSION['err']['pw']['empty'])){  ;?>
            <span style="color:red;font-size:12px">密碼欄位不得為空</span>
            <?php } ;?>
        <?php if(!empty($_SESSION['err']) && isset($_SESSION['err']['pw']['len'])){  ;?>
            <span style="color:red;font-size:12px">密碼欄位長度必須在8~16字元之間</span>
            <?php } ;?>
        </li>
        <li class="list-group-item">姓名:<input type="text" name='name'></li>
        <li class="list-group-item">生日:<input type="date" name='birthday'></li>
        <li class="list-group-item">地址:<input type="text" name='addr'></li>
        <li class="list-group-item">電話:<input type="text" name='tel'></li>
        <li class="list-group-item">email:<input type="text" name='email'></li>

        </ul>
        <div class='mx-auto' style="width:200px">
            <input class="btn btn-primary" type="submit" value="註冊">
            <input class="btn btn-warning" type="reset" value="重置">
        </div>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>