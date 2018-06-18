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
    $result=$mysqli->query("SELECT title FROM artworks WHERE artworkID='{$_GET["id"]}'");
    $artwork=$result->fetch_assoc();
    myAlert("确认删除艺术品{$artwork['title']}吗？",true,true);
}
?>
<script>
    document.getElementsByClassName("cancelButton")[0].onclick=function () {
        window.history.back();
    };

    document.getElementsByClassName("okButton")[0].onclick=function () {
        let alert=document.getElementsByClassName("shield")[0];
        alert.className="close";
        window.location.href="delete.php?id=<?php echo $_GET["id"]?>";
    }
</script>
</body>
</html>
<?php $mysqli->close();?>