<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['username'])){
    header("location:homepage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 登陆</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/main_header.css" />
    <link rel="stylesheet" type="text/css" href="css/form.css" />
<!--    <link rel="stylesheet" type="text/css" href="css/verification_code.css" />-->
    <link rel="stylesheet" type="text/css" href="css/myAlert.css" />

</head>

<body>
    <?php
    include 'checkLogin.php';
    include 'nav.php';
    ?>

    <header>
        <h1>Art Store</h1>
        <h2>To seek,show and sell your favourite art</h2>
    </header>

    <main>
        <form method="post" action="login.php">
            <fieldset>
                <legend>用户登陆</legend>
                <table cellspacing="10em">
                    <tr>
                        <td><label for="username">用户名：</label></td>
                        <td><input type="text" name="username" id="username"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="name_error">&emsp;</span></td></tr>
                    <tr>
                        <td><label for="password">密码：</label></td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr><td colspan="2"><span class="error" id="pass_error">&emsp;</span></td></tr>
<!--                    <tr>-->
<!--                        <td><label for="verification_code">验证码：</label></td>-->
<!--                        <td>-->
<!--                            <input type="text" id="verification_code">-->
<!--                            <div id="verification_img">-->
<!--                                <img src="" id="verif1"><img src="" id="verif2"><img src="" id="verif3"><img src="" id="verif4">-->
<!--                            </div>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr><td colspan="2"><span class="error" id="verification_error">&emsp;</span></td></tr>-->
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="登陆" id="go_login">
                            <button type="button" id="cancel">取消</button>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </main>

    <script src="js/login.js"></script>
    <script src="js/myAlert.js"></script>

</body>
</html>