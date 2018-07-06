<?php
$captcha="";
for($count=0;$count<4;$count++){
    $num=rand(0,9);
    $captcha.=$num;
    ?><img src="captcha/<?php echo $num?>.png" class="captcha_img" /><?php
}
$_SESSION["captcha"]=$captcha;
?>