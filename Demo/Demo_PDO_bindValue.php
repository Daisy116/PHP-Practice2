<?php

if (!isset($_GET["id"])) {
	die("id not found.");
}
$id = $_GET["id"];

$pdo = new PDO("mysql:host=127.0.0.1;dbname=northwind", 'root', '');

// prepare()處理，讓資安有保障
$cmd = $pdo->prepare("select ProductID, ProductName, UnitPrice from products where productid = :pid lock in share mode");
$cmd->bindValue(":pid", $id);    // 10、11行這樣的處理，讓$id的參數值一定不能帶上SQL語法，只能乖乖輸入數值

$cmd->execute();
$row = $cmd->fetch();
echo "$id => {$row['ProductName']}"; 


