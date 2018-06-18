<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link rel="stylesheet" type="text/css" href="css/myAlert.css" />
</head>
<body>

<?php
$mysqli = new mysqli("localhost","root","","art");
if($mysqli->connect_errno){
    die('Failed to connect to MySQL:'.$mysqli->connect_error);
}
$mysqli->query("set names 'utf8'");


include 'alert.php';

if(!isset($_SESSION)){
    session_start();
}

if(isset($_POST["artworkID"]) && $_POST["userID"]){
    $sql="INSERT INTO carts (userID,artworkID)
          VALUES ('{$_POST["userID"]}','{$_POST["artworkID"]}')";
    $result=$mysqli->query($sql);
    if($result){
        myAlert("添加购物车成功！",false);
        $_SESSION["cartNum"]++;
        ?><script>window.history.back();</script><?php
    }
    else{
        myAlert("添加失败！请检查网络设置");
    }
}
$mysqli->close();
?>
</body>
</html>
