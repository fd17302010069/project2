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
if(!isset($_SESSION['userID'])){
    header("Location:login.php"); //未登录用户跳转到登陆页面
}

if(isset($_GET['id'])){ //有id：修改 无id：发布
    $artResult=$mysqli->query("SELECT * FROM artworks WHERE artworkID='{$_GET['id']}'");
    $art=$artResult->fetch_assoc();

    $title=$art['title'];
    $artist=$art['artist'];
    $description=$art['description'];
    $year=$art['yearOfWork'];
    $genre=$art['genre'];
    $height=$art['height'];
    $width=$art['width'];
    $price=$art['price'];
    $img="img/".$art['imageFileName'];
    $fileRequired="";
    $action="revise.php?id=".$_GET['id'];
}
else{
    $title="";
    $artist="";
    $description="";
    $year="";
    $genre="";
    $height="";
    $width="";
    $price="";
    $img="";
    $fileRequired="required";
    $action="upload.php";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 发布艺术品</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/content_header.css" />
    <link rel="stylesheet" type="text/css" href="css/launch.css" />
    <link rel="stylesheet" type="text/css" href="css/trace.css" />
</head>
<body>

    <?php
    include "nav.php";
    include "header.php";
    ?>

    <main>
        <form class="launch" enctype="multipart/form-data" method="post" action="<?php echo $action?>">
            <fieldset>
                <legend><h2>发布艺术品</h2></legend>
                <table cellspacing="10em">
                    <tr>
                        <td colspan="2">
                            <label for="art_title" class="launch_label">名称</label>
                            <input type="text" name="art_title" id="art_title" value="<?php echo $title?>" class="launch_input long" required>
                            <br /><span class="error">&emsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="art_artist" class="launch_label">作者</label>
                            <input type="text" name="art_artist" id="art_artist" value="<?php echo $artist?>" class="launch_input long" required>
                            <br /><span class="error">&emsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="art_description" class="launch_label">简介</label>
                            <textarea name="art_description" id="art_description" required><?php echo $description?></textarea>
                            <br /><span class="error">&emsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="year" class="launch_label">年份</label>
                            <input type="number" name="year" id="year" value="<?php echo $year?>" step="1" class="launch_input" required title="年份必须为整数">
                            <br /><span class="error">&emsp;</span>
                        </td>
                        <td>
                            <label for="genre" class="launch_label">流派</label>
                            <input type="text" name="genre" id="genre" value="<?php echo $genre?>" class="launch_input" required>
                            <br /><span class="error">&emsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="height" class="launch_label">长度</label>
                            <input type="number" name="height" id="height" value="<?php echo $height?>" min="0.01" step="0.01" class="launch_input" required title="长度必须为正数">
                            <br /><span class="error">&emsp;</span>
                        </td>
                        <td>
                            <label for="width" class="launch_label">宽度</label>
                            <input type="number" name="width" id="width" value="<?php echo $width?>" min="0.01" step="0.01" class="launch_input" required title="宽度必须为正数">
                            <br /><span class="error">&emsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="price" class="launch_label">价格</label>
                            <input type="number" name="price" id="price" value="<?php echo $price?>" min="1" step="1" class="launch_input" required title="价格必须为正整数">
                            <br /><span class="error">&emsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="file" class="launch_label">图片</label>
                            <input type="file" name="file" id="file" accept="image/*" <?php echo $fileRequired?>>
                            <br /><span class="error">&emsp;</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <img src="<?php echo $img?>" id="img_preview">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="提交" class="launch_btn">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </main>

    <script src="js/launch.js"></script>

</body>
</html>
