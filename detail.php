<?php
$mysqli = new mysqli("localhost","root","","art");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 商品详情</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/content_header.css" />
    <link rel="stylesheet" type="text/css" href="css/details.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>

<body>
    <?php
        include 'nav.php';
        include 'header.php';
    ?>

    <main>
        <?php
        if(isset($_GET['id'])){
            $result=$mysqli->query("SELECT * FROM artworks WHERE artworkID='{$_GET['id']}'");
            $artwork=$result->fetch_assoc();
        ?>
            <h2><?php echo $artwork["title"]?></h2>
            <p>By <span id="artist"><a href="#"><?php echo $artwork["artist"]?></a></span></p>
            <img src="img/<?php echo $artwork["imageFileName"]?>" alt="<?php echo $artwork["title"]?>" height="500">
            <section>
                <p class="tag">PRICE: <span id="price"><?php echo $artwork["price"]?></span></p>
                <p class="tag">HEAT: <span id="heat"><?php echo $artwork["view"]?></span></p>
                <button id="add"><i class="fas fa-shopping-cart"></i> Add to Shopping Cart</button>
                <table border="2">
                    <tr>
                        <th colspan="2">Product Details</th>
                    </tr>
                    <tr>
                        <td>Year Of Work</td>
                        <td><?php echo $artwork["yearOfWork"]?></td>
                    </tr>
                    <tr>
                        <td>Dimensions</td>
                        <td><?php echo $artwork["width"]?> X <?php echo $artwork["height"]?></td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td><?php echo $artwork["genre"]?></td>
                    </tr>
                </table>
            </section>

            <section class="intro">
                <h3>Introduction</h3>
                <p><?php echo $artwork["description"]?></p>
            </section>
        <?php
        }
        ?>
    </main>
</body>