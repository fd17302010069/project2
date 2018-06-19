<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link rel="stylesheet" type="text/css" href="css/myAlert.css" />
</head>
<body>

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

if(isset($_POST["sum_price"]) && isset($_POST["user_balance"])){
    if((int)($_POST["user_balance"]) < (int)($_POST["sum_price"])){
        myAlert("余额不足！",false);
        ?><script>window.history.back();</script><?php
    }
    else{
        $sql = "SELECT * FROM carts WHERE userID='{$_SESSION['userID']}'";
        $cartResult = $mysqli->query($sql);
        $canPay=true;

        while ($row=$cartResult->fetch_assoc()) {
            $artResult = $mysqli->query("SELECT * FROM artworks WHERE artworkID='{$row["artworkID"]}'");
            $artWork = $artResult->fetch_assoc();
            if(!$artWork){
                myAlert("艺术品已被删除或不存在！");
                $canPay=false;
                break;
            }
            if($artWork["orderID"]!==null){ //艺术品已被买走
                myAlert("艺术品{$artWork['title']}已售出！");
                $canPay=false;
                break;
            }
            if(strtotime($artWork["timeRevised"])>=strtotime($row["timeAdded"])){ //添加购物车后商品发生修改
                myAlert("艺术品{$artWork['title']}信息被修改！请重新添加购物车");
                $canPay=false;
                break;
            }
        }

        if($canPay){
            $orderSql = "INSERT INTO orders (ownerID,sum)
                          VALUES ('{$_SESSION["userID"]}','{$_POST["sum_price"]}')";
            $orderResult = $mysqli->query($orderSql);
            $orderID = $mysqli->insert_id;

            $afterBalance = $_POST["user_balance"] - $_POST["sum_price"];
            $mysqli->query("UPDATE users SET balance='$afterBalance' WHERE userID='{$_SESSION["userID"]}'");
            $_SESSION["balance"] = $afterBalance;

            $cartResult = $mysqli->query($sql);
            while ($row = $cartResult->fetch_assoc()) {
                $mysqli->query("UPDATE artworks SET orderID='$orderID' WHERE artworkID='{$row["artworkID"]}'");

                $artResult = $mysqli->query("SELECT price,ownerID FROM artworks WHERE artworkID='{$row["artworkID"]}'");
                $artWork = $artResult->fetch_assoc();
                $ownerResult = $mysqli->query("SELECT balance FROM users WHERE userID='{$artWork["ownerID"]}'");
                $owner = $ownerResult->fetch_assoc();
                $newBalance = $owner["balance"] + $artWork["price"];
                $mysqli->query("UPDATE users SET balance='$newBalance' WHERE userID='{$artWork["ownerID"]}'");

                $mysqli->query("DELETE FROM carts WHERE cartId='{$row["cartID"]}'");
            }

            $_SESSION['cartNum'] = 0;
            myAlert("下单成功！",false);
            ?><script>window.location.href="shoppingCart.php";</script><?php
        }
    }
}
$mysqli->close();
?>

<script>
    document.getElementsByClassName("okButton")[0].onclick=function () {
        window.history.back();
    };
</script>
</body>
</html>