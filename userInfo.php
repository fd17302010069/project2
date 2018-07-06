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
else{
    $result=$mysqli->query("SELECT * FROM users WHERE userID='{$_SESSION['userID']}'");
    $userInfo=$result->fetch_assoc();
    $artResult=$mysqli->query("SELECT * FROM artworks WHERE ownerID='{$_SESSION['userID']}'");
    $orderResult=$mysqli->query("SELECT * FROM orders WHERE ownerID='{$_SESSION['userID']}'");
    $soldResult=$mysqli->query("SELECT * FROM artworks WHERE (ownerID='{$_SESSION['userID']}')&&(orderID is not NULL)");

    if(isset($_POST["recharge_value"])){
        $newBalance=(int)$userInfo["balance"]+(int)$_POST["recharge_value"];
        $sql="UPDATE users SET balance='$newBalance' WHERE userID='{$_SESSION['userID']}'";
        $rechargeResult=$mysqli->query($sql);
        if($rechargeResult){
            myAlert("充值成功！");
            $userInfo["balance"]=$newBalance;
            $_SESSION["balance"]=$newBalance;
        }
        else{
            myAlert("充值失败！请检查网络设置");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 用户信息</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/content_header.css" />
    <link rel="stylesheet" type="text/css" href="css/user_info.css" />
    <link rel="stylesheet" type="text/css" href="css/myAlert.css" />
    <link rel="stylesheet" type="text/css" href="css/trace.css" />
</head>
<body>
    <?php
        include 'nav.php';
        include 'header.php';
    ?>

    <main>
        <section id="user_info">
            <h2>个人信息</h2>
            <div>
                用户名：<?php echo $userInfo["name"]?>
                <br />
                邮箱：<?php echo $userInfo["email"]?>
                <br />
                电话：<?php echo $userInfo["tel"]?>
                <br />
                地址：<?php echo $userInfo["address"]?>
                <br />
                余额：<?php echo $userInfo["balance"]?>
                <form id="recharge_form" method="post" action="userInfo.php">
                    <input type="number" title="请输入充值金额" name="recharge_value" id="recharge_value" min="1" step="1" required>
                    <button type="submit" name="recharge" id="recharge">充值</button>
                </form>
            </div>
        </section>

        <section id="upload">
            <h2>我上传的艺术品</h2>
            <table border="2">
                <tr>
                    <th>商品名称</th>
                    <th>上传日期</th>
                    <th>修改</th>
                    <th>删除</th>
                </tr>
                <?php
                while($row=$artResult->fetch_assoc()){
                    ?>
                    <tr>
                        <td><a href="detail.php?id=<?php echo $row["artworkID"];?>"><?php echo $row["title"];?></a></td>
                        <td><?php echo explode(" ",$row["timeReleased"])[0];?></td>
                        <?php
                        if($row["orderID"]===null){
                            ?>
                            <td><a href="launch.php?id=<?php echo $row["artworkID"];?>">修改</a></td>
                            <td><a href="deleteConfirm.php?id=<?php echo $row["artworkID"];?>">删除</a></td>
                            <?php
                        }
                        else{
                            ?>
                            <td><span class="unavailable">修改</span></td>
                            <td><span class="unavailable">删除</span></td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                if($artResult->num_rows===0){
                    echo '<tr><td colspan="4">没有上传的艺术品</td></tr>';
                }
                ?>
            </table>
        </section>

        <section id="bought">
            <h2>我购买的艺术品</h2>
            <table border="2">
                <tr>
                    <th>订单编号</th>
                    <th>商品名称</th>
                    <th>订单时间</th>
                    <th>订单金额</th>
                </tr>
                <?php
                while($row=$orderResult->fetch_assoc()){
                    $artInOrder=$mysqli->query("SELECT * FROM artworks WHERE orderID='{$row["orderID"]}'"); //获取对应订单编号中的所有艺术品
                    $artCount=$artInOrder->num_rows;
                    ?>
                    <tr>
                        <td rowspan="<?php echo $artCount;?>"><?php echo $row["orderID"];?></td>
                        <?php
                            $r1=$artInOrder->fetch_assoc(); //先取出第一个商品放入表格第一行
                        ?>
                        <td><a href="detail.php?id=<?php echo $r1["artworkID"];?>"><?php echo $r1["title"];?></a></td>
                        <td rowspan="<?php echo $artCount;?>"><?php echo $row["timeCreated"];?></td>
                        <td rowspan="<?php echo $artCount;?>"><?php echo $row["sum"];?></td>
                    </tr>
                    <?php
                    while($r=$artInOrder->fetch_assoc()){
                        ?>
                        <tr>
                            <td><a href="detail.php?id=<?php echo $r["artworkID"];?>"><?php echo $r["title"];?></a></td>
                        </tr>
                        <?php
                    }
                }
                if($orderResult->num_rows===0){
                    echo '<tr><td colspan="4">没有购买的艺术品</td></tr>';
                }
                ?>
            </table>
        </section>

        <section id="sold">
            <h2>我卖出的艺术品</h2>
            <table border="2">
                <tr>
                    <th>商品名称</th>
                    <th>卖出时间</th>
                    <th>卖出金额</th>
                    <th>买家信息</th>
                </tr>
                <?php
                while ($row=$soldResult->fetch_assoc()){
                    $orderID=$row["orderID"];
                    $currentOrderResult=$mysqli->query("SELECT * FROM orders WHERE orderID='$orderID'");
                    $currentOrder=$currentOrderResult->fetch_assoc();
                    $buyerID=$currentOrder["ownerID"];
                    $currentBuyerResult=$mysqli->query("SELECT * FROM users WHERE userID='$buyerID'");
                    $currentBuyer=$currentBuyerResult->fetch_assoc();
                    ?>
                    <tr>
                        <td><a href="detail.php?id=<?php echo $row["artworkID"];?>"><?php echo $row["title"];?></a></td>
                        <td><?php echo $currentOrder["timeCreated"];?></td>
                        <td><?php echo $row["price"];?></td>
                        <td>
                            <?php
                            echo "用户名：".$currentBuyer["name"]."<br />";
                            echo "邮箱：".$currentBuyer["email"]."<br />";
                            echo "电话：".$currentBuyer["tel"]."<br />";
                            echo "地址：".$currentBuyer["address"];
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                if($soldResult->num_rows===0){
                    echo '<tr><td colspan="4">没有卖出的艺术品</td></tr>';
                }
                ?>
            </table>
        </section>
    </main>

<script src="js/userInfo.js"></script>
<script src="js/myAlert.js"></script>

</body>
</html>
<?php $mysqli->close(); ?>