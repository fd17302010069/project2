<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link rel="stylesheet" type="text/css" href="css/myAlert.css" />
</head>
<body>
<?php
include 'alert.php';

if(!isset($_SESSION)){
    session_start();
}
$_SESSION=array(); //清空session
setcookie(session_name(),'',time()-3600,'/'); //清空cookie中的session ID
session_destroy();

myAlert("登出成功！",false);

?>
<script>window.location.href="login.php"</script>
</body>
</html>