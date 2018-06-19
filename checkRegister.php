<?php
$mysqli = new mysqli("localhost","root","","art");
if($mysqli->connect_errno){
    die('Failed to connect to MySQL:'.$mysqli->connect_error);
}
$mysqli->query("set names 'utf8'");

include 'alert.php';

if(!isset($_POST['username'])){
    if(!isset($_SESSION['username'])){
        return;
    }
    else{
        header("location:homepage.php");
    }
}
else{
    $result=$mysqli->query("SELECT name FROM users WHERE name='{$_POST['username']}'");
    $user=$result->fetch_assoc();

    if($user){
        myAlert("用户名已存在！");
    }
    else{
        $sql="INSERT INTO users (name,email,password,tel,address) 
              VALUES ('{$_POST['username']}','{$_POST['email']}','{$_POST['password']}','{$_POST['phone']}','{$_POST['address']}')";
        $result=$mysqli->query($sql);

        if($result){
            $userResult=$mysqli->query("SELECT userID FROM users WHERE name='{$_POST['username']}'");
            $user=$userResult->fetch_assoc();

            $_SESSION["username"]=$_POST['username'];
            $_SESSION["cartNum"]=0;
            $_SESSION["balance"]=0;
            $_SESSION["userID"]=$user['userID'];

            myAlert("注册成功！",false);
            ?><script>window.location.href='homepage.php';</script><?php
        }
        else{
            myAlert("数据库连接失败，请检查设置");
        }
    }
}
$mysqli->close();
?>