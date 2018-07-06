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
    $artResult=$mysqli->query("SELECT * FROM artworks WHERE artworkID='{$_GET["id"]}'");
    $artWork=$artResult->fetch_assoc();

    if($_POST["art_title"]!==$artWork["title"]){
        $title=$mysqli->real_escape_string($_POST["art_title"]);
        $mysqli->query("UPDATE artworks SET title='$title' WHERE artworkID='{$_GET["id"]}'");
    }
    if($_POST["art_artist"]!==$artWork["artist"]){
        $artist=$mysqli->real_escape_string($_POST["art_artist"]);
        $mysqli->query("UPDATE artworks SET artist='$artist' WHERE artworkID='{$_GET["id"]}'");
    }
    if($_POST["art_description"]!==$artWork["description"]){
        $description=$mysqli->real_escape_string($_POST["art_description"]);
        $mysqli->query("UPDATE artworks SET description='$description' WHERE artworkID='{$_GET["id"]}'");
    }
    if($_POST["year"]!==$artWork["yearOfWork"]){
        $mysqli->query("UPDATE artworks SET yearOfWork='{$_POST["year"]}' WHERE artworkID='{$_GET["id"]}'");
    }
    if($_POST["genre"]!==$artWork["genre"]){
        $genre=$mysqli->real_escape_string($_POST["genre"]);
        $mysqli->query("UPDATE artworks SET genre='$genre' WHERE artworkID='{$_GET["id"]}'");
    }
    if($_POST["height"]!==$artWork["height"]){
        $mysqli->query("UPDATE artworks SET height='{$_POST["height"]}' WHERE artworkID='{$_GET["id"]}'");
    }
    if($_POST["width"]!==$artWork["width"]){
        $mysqli->query("UPDATE artworks SET width='{$_POST["width"]}' WHERE artworkID='{$_GET["id"]}'");
    }
    if($_POST["price"]!==$artWork["price"]){
        $mysqli->query("UPDATE artworks SET price='{$_POST["price"]}' WHERE artworkID='{$_GET["id"]}'");
    }

    if(!empty($_FILES["file"]["tmp_name"])){
        if($_FILES["file"]["error"]>0){
            die('Error:'.$_FILES["file"]["error"]);
        }
        unlink("img/".$artWork["imageFileName"]); //删除原图片
        move_uploaded_file($_FILES["file"]["tmp_name"],"img/".$artWork["imageFileName"]);
    }

    $mysqli->query("UPDATE artworks SET timeRevised=CURRENT_TIMESTAMP WHERE artworkID='{$_GET["id"]}'"); //更新修改时间

    myAlert("修改成功！",false);
    ?><script>window.location.href="detail.php?id=<?php echo $_GET["id"];?>";</script><?php
}
$mysqli->close();
?>
</body>
</html>