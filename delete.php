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
    $result=$mysqli->query("SELECT imageFileName FROM artworks WHERE artworkID='{$_GET["id"]}'");
    $artwork=$result->fetch_assoc();
    $path="img/".$artwork["imageFileName"];

    $result=$mysqli->query("DELETE FROM artworks WHERE artworkID='{$_GET["id"]}'");

    if($result){
        unlink($path);
        myAlert("删除成功！",false);
        ?><script>window.location.href="userInfo.php";</script><?php
    }
    else{
        myAlert("删除失败！请检查网络设置");
    }
}
$mysqli->close();
?>
</body>
</html>