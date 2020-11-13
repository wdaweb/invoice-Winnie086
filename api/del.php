<?php

include_once "../base.php";

$pdo->exec("delete from invoice where id='{$_GET['id']}'");
header("location:../index.php?do=invoice_list");

?>