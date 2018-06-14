<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['username'])){
    header("location:homepage.php");
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 注册</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/main_header.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
    <link rel="stylesheet" type="text/css" href="css/myAlert.css" />
</head>
<body>
    <?php
    include 'nav.php';

    ?>

    <header>
        <h1>Art Store</h1>
        <h2>To seek,show and sell your favourite art</h2>
    </header>

    <main>
        <form method="post" action="register.php">
            <fieldset>
                <legend>新用户注册</legend>
                <table cellspacing="10em">
                    <tr>
                        <td><label for="username">用户名：</label></td>
                        <td><input type="text" name="username" id="username"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="name_error">&nbsp;</span></td></tr>
                    <tr>
                        <td><label for="password">密码：</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="pass_error">&nbsp;</span></td></tr>
                    <tr>
                        <td><label for="password_again">确认密码：</label></td>
                        <td><input type="password" name="password_again" id="password_again"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="pass_again_error">&nbsp;</span></td></tr>
                    <tr>
                        <td><label for="email">邮箱：</label></td>
                        <td><input type="email" name="email" id="email"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="email_error">&nbsp;</span></td></tr>
                    <tr>
                        <td><label for="phone">电话：</label></td>
                        <td><input type="tel" name="phone" id="phone"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="phone_error">&nbsp;</span></td></tr>
                    <tr>
                        <td><label for="address">地址：</label></td>
                        <td><input type="text" name="address" id="address"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="address_error">&nbsp;</span></td></tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="注册" id="go_register">
                            <button type="button" id="cancel">取消</button>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </main>

<?php include 'checkRegister.php'?>

<script src="js/register.js"></script>
<script src="js/myAlert.js"></script>
</body>
</html>

