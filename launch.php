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
</head>
<body>

    <?php
    include "nav.php";
    include "header.php";
    ?>

    <main>
        <form class="launch">
            <fieldset>
                <legend><h2>发布艺术品</h2></legend>
                <table cellspacing="10em">
                    <tr>
                        <td colspan="2">
                            <label for="title" class="launch_label">名称</label>
                            <input type="text" name="title" id="title" class="launch_input long">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="artist" class="launch_label">作者</label>
                            <input type="text" name="artist" id="artist" class="launch_input long">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="description" class="launch_label">简介</label>
                            <textarea name="description" id="description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="year" class="launch_label">年份</label>
                            <input type="number" name="year" id="year" step="1" class="launch_input">
                        </td>
                        <td>
                            <label for="genre" class="launch_label">流派</label>
                            <input type="text" name="genre" id="genre" class="launch_input">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="height" class="launch_label">长度</label>
                            <input type="number" name="height" id="height" min="0" class="launch_input">
                        </td>
                        <td>
                            <label for="width" class="launch_label">宽度</label>
                            <input type="number" name="width" id="width" min="0" class="launch_input">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <label for="price" class="launch_label">价格</label>
                            <input type="number" name="price" id="price" min="1" step="1" class="launch_input">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="file" class="launch_label">图片</label>
                            <input type="file" name="file" id="file">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <img src="" id="img_preview">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="提交"  class="launch_btn">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </main>
    <script src="js/launch.js"></script>

</body>
</html>
