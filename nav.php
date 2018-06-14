<nav>
    <ul>
        <li><a href="homepage.php" class="link">首页</a></li>
        <li><a href="search.php" class="link">搜索</a></li>
        <li><a href="detail.php" class="link">商品详情</a></li>
        <?php
            if(!isset($_SESSION)){
                session_start();
            }
            if(!isset($_SESSION['username'])) {
                ?>
                <li><a href="login.php" class="link">登陆</a></li>
                <li><a href="register.php" class="link">注册</a></li>
                <?php
            }
            else{
                ?>
                <li><a href="userInfo.php" class="link">个人信息</a></li>
                <li><a href="#" class="link">发布艺术品</a></li>
                <li>
                    <a href="#" class="link">购物车</a>
                    <ul><li>商品数量：<?php echo $_SESSION['cartNum']?></li></ul>
                </li>
                <li><a href="logout.php" class="link">登出</a></li>
                <?php
            }
        ?>
    </ul>
</nav>