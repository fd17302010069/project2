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

if(isset($_GET["id"])){
    $result=$mysqli->query("DELETE FROM carts WHERE cartId='{$_GET["id"]}'");
    if($result){
        myAlert("移出购物车成功！",false);
        $_SESSION["cartNum"]--;
        ?><script>window.history.back();</script><?php
    }
    else{
        myAlert("移除失败！请检查网络设置");
    }
}
$mysqli->close();
?>
</body>
</html>