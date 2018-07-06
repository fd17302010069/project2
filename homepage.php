<?php
$mysqli = new mysqli("localhost","root","","art");
if($mysqli->connect_errno){
    die('Failed to connect to MySQL:'.$mysqli->connect_error);
}
$mysqli->query("set names 'utf8'"); //修正读取数据库时出现的乱码
$hottestResult=$mysqli->query("SELECT * FROM artworks WHERE orderID is Null ORDER BY view desc LIMIT 0,3");
$latestResult=$mysqli->query("SELECT * FROM artworks WHERE orderID is Null ORDER BY timeReleased desc LIMIT 0,3");

$hottestArt=array();
while($row=$hottestResult->fetch_assoc()){
    if(mb_strlen($row["description"])>260){
        $row["description"]=mb_substr($row["description"],0,260,"UTF8")."...";
    }
    $hottestArt[]=$row;
}

$latestArt=array();
while($row=$latestResult->fetch_assoc()){
    if(mb_strlen($row["description"])>400){
        $row["description"]=mb_substr($row["description"],0,400,"UTF8")."...";
    }
    $latestArt[]=$row;
}
if(!isset($_COOKIE["trace"])){
    setcookie("trace","<a class='traceTag' href='{$_SERVER["REQUEST_URI"]}'>首页</a>");
}
else{
    $current="<a class='traceTag' href='{$_SERVER["REQUEST_URI"]}'>首页</a>";
    $newValue=$_COOKIE["trace"]."+".$current;
    setcookie("trace",$newValue);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 首页</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/main_header.css" />
    <link rel="stylesheet" type="text/css" href="css/homepage.css" />
</head>
<body>
    <?php include 'nav.php';?>

    <header>
        <h1>Art Store</h1>
        <h2>To seek,show and sell your favourite art</h2>
    </header>

    <main>
        <div class="gallery_border">
            <section class="gallery">
                <div class="gallery_frame">
                    <a href="detail.php?id=<?php echo $hottestArt[0]['artworkID']?>"><img src="img/<?php echo $hottestArt[0]['imageFileName']?>" alt="Gallery" height="640" class="gallery_img"></a>
                </div>
                <article>
                    <div class="info">
                        <h3><?php echo $hottestArt[0]['title']?></h3>
                        <p>By <?php echo $hottestArt[0]['artist']?></p>
                    </div>
                    <p class="intro"><?php echo $hottestArt[0]['description']?></p>
                </article>
            </section>

            <section class="gallery none">
                <div class="gallery_frame">
                    <a href="detail.php?id=<?php echo $hottestArt[1]['artworkID']?>"><img src="img/<?php echo $hottestArt[1]['imageFileName']?>" alt="Gallery" height="640" class="gallery_img"></a>
                </div>
                <article>
                    <div class="info">
                        <h3><?php echo $hottestArt[1]['title']?></h3>
                        <p>By <?php echo $hottestArt[1]['artist']?></p>
                    </div>
                    <p class="intro"><?php echo $hottestArt[1]['description']?></p>
                </article>
            </section>

            <section class="gallery none">
                <div class="gallery_frame">
                    <a href="detail.php?id=<?php echo $hottestArt[2]['artworkID']?>"><img src="img/<?php echo $hottestArt[2]['imageFileName']?>" alt="Gallery" height="640" class="gallery_img"></a>
                </div>
                <article>
                    <div class="info">
                        <h3><?php echo $hottestArt[2]['title']?></h3>
                        <p>By <?php echo $hottestArt[2]['artist']?></p>
                    </div>
                    <p class="intro"><?php echo $hottestArt[2]['description']?></p>
                </article>
            </section>
        </div>

        <section class="top_three">
            <article>
                <img src="img/<?php echo $latestArt[0]['imageFileName']?>" alt="first art <?php echo $latestArt[0]['title']?>" width="150" height="150">
                <div class="info">
                    <h3><?php echo $latestArt[0]['title']?></h3>
                    <p>By <?php echo $latestArt[0]['artist']?></p>
                </div>
                <p class="intro"><?php echo $latestArt[0]['description']?></p>
                <a href="detail.php?id=<?php echo $latestArt[0]['artworkID']?>" class="more">Learn More</a>
            </article>

            <article>
                <img src="img/<?php echo $latestArt[2]['imageFileName']?>" alt="third art <?php echo $latestArt[2]['title']?>" width="150" height="150">
                <div class="info">
                    <h3><?php echo $latestArt[2]['title']?></h3>
                    <p>By <?php echo $latestArt[2]['artist']?></p>
                </div>
                <p class="intro"><?php echo $latestArt[2]['description']?></p>
                <a href="detail.php?id=<?php echo $latestArt[2]['artworkID']?>" class="more">Learn More</a>
            </article><!--为保证三张图片布局正确，这里放置第三张-->

            <article>
                <img src="img/<?php echo $latestArt[1]['imageFileName']?>" alt="second art <?php echo $latestArt[1]['title']?>" width="150" height="150">
                <div class="info">
                    <h3><?php echo $latestArt[1]['title']?></h3>
                    <p>By <?php echo $latestArt[1]['artist']?></p>
                </div>
                <p class="intro"><?php echo $latestArt[1]['description']?></p>
                <a href="detail.php?id=<?php echo $latestArt[1]['artworkID']?>" class="more">Learn More</a>
            </article>
        </section>
    </main>


<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
<script src="js/homepage.js"></script>
<script src="js/gallery.js"></script>
</body>
</html>

<?php $mysqli->close(); ?>