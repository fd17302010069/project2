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

if(isset($_POST["art_title"]) && isset($_FILES["file"])){
    if($_FILES["file"]["error"]>0){
        die('Error:'.$_FILES["file"]["error"]);
    }

    //将上传信息中的特殊字符转义 //如\'
    $artist=$mysqli->real_escape_string($_POST["art_artist"]);
    $title=$mysqli->real_escape_string($_POST["art_title"]);
    $description=$mysqli->real_escape_string($_POST["art_description"]);
    $year=$mysqli->real_escape_string($_POST["year"]);
    $genre=$mysqli->real_escape_string($_POST["genre"]);
    $width=$mysqli->real_escape_string($_POST["width"]);
    $height=$mysqli->real_escape_string($_POST["height"]);
    $price=$mysqli->real_escape_string($_POST["price"]);

    $sql="INSERT INTO artworks (artist,title,description,yearOfWork,genre,width,height,price,ownerID)
          VALUES ('$artist',
                  '$title',
                  '$description',
                  '$year',
                  '$genre',
                  '$width',
                  '$height',
                  '$price',
                  '{$_SESSION["userID"]}')";
    $result=$mysqli->query($sql);

    if($result){
        $id=$mysqli->insert_id;  //新插入数据的id
        $fileName=$id.".jpg";

        move_uploaded_file($_FILES["file"]["tmp_name"],"img/".$fileName);

        $ChangeNameSql="UPDATE artworks SET imageFileName='$fileName' WHERE artworkID='$id'";
        $ChangeNameResult=$mysqli->query($ChangeNameSql);

        if($ChangeNameResult){
            myAlert("发布成功！",false);
            ?><script>window.location.href="detail.php?id=<?php echo $id?>"</script><?php

        }
        else{
            myAlert("上传失败！请检查网络设置");
        }
    }
    else{
        myAlert("上传失败！请检查网络设置");
    }
}
$mysqli->close();
?>

</body>
</html>
