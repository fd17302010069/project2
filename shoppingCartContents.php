<section>
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
    $sql="SELECT * FROM carts WHERE userID='{$_SESSION['userID']}'";
    $cartResult=$mysqli->query($sql);

    if($cartResult){
        $totalCount=$cartResult->num_rows;
    }
    else{
        $totalCount=0;
    }

    if($totalCount===0){
        echo'<p class="hint">购物车内没有物品</p>';
    }
    else{
        $pageSize=10;
        $totalPage=(int)(($totalCount % $pageSize === 0) ? ($totalCount / $pageSize):($totalCount / $pageSize+1));

        $currentPage = !isset($_POST['page']) ? 1 : $_POST['page'];

        $mark=($currentPage-1)*$pageSize;
        $firstPage=1;
        $lastPage=$totalPage;
        $prePage=($currentPage>1)?($currentPage-1):1;
        $nextPage=($currentPage<$totalPage)?($currentPage+1):$totalPage;

        $sql.=" LIMIT ".$mark.",".$pageSize;
        $cartResult=$mysqli->query($sql);

        $sumPrice=0;

        while ($row=$cartResult->fetch_assoc()){
            $artResult=$mysqli->query("SELECT * FROM artworks WHERE artworkID='{$row["artworkID"]}'");
            $artWork=$artResult->fetch_assoc();
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
                    --><button class="delete"><i class="far fa-trash-alt"></i> 删除</button>
                </p>
            </div>
            <?php
        }
        ?>
</section>

        <div id="page">
            <span class="page_btn" onclick="turnPageForCart(<?php echo $firstPage?>)">首页</span>
            <span class="page_btn" onclick="turnPageForCart(<?php echo $prePage?>)">上一页</span>
            <span class="page_btn" onclick="turnPageForCart(<?php echo $nextPage?>)">下一页</span>
            <span class="page_btn" onclick="turnPageForCart(<?php echo $lastPage?>)">尾页</span>
            第<?php echo $currentPage?>页/共<?php echo $totalPage?>页
        </div>

        <button id="pay"><i class="fas fa-share"></i> 结款：<?php echo $sumPrice;?></button>
        <?php
    }
}
$mysqli->close();?>