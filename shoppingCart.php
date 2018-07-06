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
else {
    $sql = "SELECT * FROM carts WHERE userID='{$_SESSION['userID']}'";
    $cartResult = $mysqli->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 购物车</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/content_header.css" />
    <link rel="stylesheet" type="text/css" href="css/shopping_cart.css" />
    <link rel="stylesheet" type="text/css" href="css/myAlert.css" />
    <link rel="stylesheet" type="text/css" href="css/trace.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>

<body>
    <?php
    include "nav.php";
    include "header.php";
    ?>

    <main>
        <h2>购物车</h2>
        <section>
            <?php
            $sumPrice=0;
            while ($row=$cartResult->fetch_assoc()){
                $artResult=$mysqli->query("SELECT * FROM artworks WHERE artworkID='{$row["artworkID"]}'");
                $artWork=$artResult->fetch_assoc();

                if(!$artWork){ //购物车中存在已被删除的商品
                    ?>
                    <div class="product">
                        <h3 class="intro">此商品已被删除！</h3>
                        <p>
                            <span class="delete"><a href="removeFromCart.php?id=<?php echo $row["cartID"];?>"><i class="far fa-trash-alt"></i> 删除</a></span>
                        </p>
                    </div>
                    <?php
                    continue;
                }

                $sumPrice+=$artWork["price"];
                if(mb_strlen($artWork["description"])>300){
                    $artWork["description"]=mb_substr($artWork["description"],0,300,"UTF8")."...";
                }
                ?>
                <div class="product">
                    <img src="img/<?php echo $artWork["imageFileName"];?>" alt="<?php echo $artWork["title"];?>" width="150" height="150">
                    <h3><?php echo $artWork["title"];?></h3>
                    <p class="artist"><?php echo $artWork["artist"];?></p>
                    <p class="intro"><?php echo $artWork["description"];?></p>
                    <p>
                        <span class="view_detail"><a href="detail.php?id=<?php echo $artWork["artworkID"];?>">查看详情</a></span><!--
                    --><span class="detail">价格：<?php echo $artWork["price"];?></span><!--
                    --><span class="delete"><a href="removeFromCart.php?id=<?php echo $row["cartID"];?>"><i class="far fa-trash-alt"></i> 删除</a></span>
                    </p>
                </div>
                <?php
            }
            if($cartResult->num_rows===0){
                echo'<p class="hint">购物车内没有物品</p>';
            }
            ?>
        </section>

        <?php
        if($cartResult->num_rows!==0) {
            ?>
            <button id="pay"><i class="fas fa-share"></i> 结款：<?php echo $sumPrice; ?></button>
            <?php
        }
        ?>

        <form id="pay_order" method="post" action="pay.php">
            <input type="hidden" name="sum_price" value="<?php echo $sumPrice;?>">
            <input type="hidden" name="user_balance" value="<?php echo $_SESSION["balance"];?>">
        </form>
    </main>

    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
    <script src="js/myAlert.js"></script>
    <script src="js/shoppingCart.js"></script>

</body>
</html>
<?php $mysqli->close();?>