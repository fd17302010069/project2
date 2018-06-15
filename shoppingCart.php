<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 购物车</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/content_header.css" />
    <link rel="stylesheet" type="text/css" href="css/shopping_cart.css" />
    <link rel="stylesheet" type="text/css" href="css/page.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
</head>

<body>
    <?php
    include "nav.php";
    include "header.php";
    ?>

    <main>
        <h2>购物车</h2>

        <div id="cart_content">
            <?php include 'shoppingCartContents.php'; ?>
        </div>
    </main>

    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
    <script src="js/shoppingCart.js"></script>
    <script src="js/page.js"></script>
</body>
</html>