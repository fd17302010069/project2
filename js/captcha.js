document.onload=function () {
    document.getElementsByClassName("captcha_img_box")[0].innerHTML="<?php include \"captcha.php\";?>";
};