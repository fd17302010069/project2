<?php
header("Cache-control: private");
$mysqli = new mysqli("localhost","root","","art");
if($mysqli->connect_errno){
    die('Failed to connect to MySQL:'.$mysqli->connect_error);
}
$mysqli->query("set names 'utf8'");

include 'alert.php';

if(!isset($_SESSION)){
    session_start();
}

if(!isset($_POST['username'])){
    if(!isset($_SESSION['username'])){
        return;
    }
    else{
        header("location:homepage.php");
    }
}
else{
    $result=$mysqli->query("SELECT * FROM users WHERE name='{$_POST['username']}'");
    $user=$result->fetch_assoc();

    if(!$user){
        myAlert("用户不存在！");
    }
    else{
        if($user['password'] !== $_POST['password']){
            myAlert("用户名或密码错误");
        }
        else{
            $cartInfo=$mysqli->query("SELECT * FROM carts WHERE userID='{$user['userID']}'");
            $cartNum=$cartInfo->num_rows;

            $_SESSION["username"]=$_POST['username'];
            $_SESSION["cartNum"]=$cartNum;
            $_SESSION["balance"]=$user['balance'];
            $_SESSION["userID"]=$user['userID'];

            myAlert("登陆成功！",false);
            ?><script>window.history.go(-2);</script><?php //TODO:登陆后回到上一个页面

        }
    }
}
$mysqli->close();
?>