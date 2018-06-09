<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store - 搜索</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" />
    <link rel="stylesheet" type="text/css" href="css/content_header.css" />
    <link rel="stylesheet" type="text/css" href="css/search.css" />
    <link rel="stylesheet" type="text/css" href="css/page.css" />
</head>

<body>
    <?php
        include 'nav.php';
        include 'header.php';
    ?>

    <main>
        <h2>搜索结果：</h2>
        <form id="order">
            排序方式：
            <label for="price">价格</label><!--
         --><input type="radio" name="sort" value="price" id="price">
            <label for="view">热度</label><!--
         --><input type="radio" name="sort" value="view" id="view">
            <label for="title">标题</label><!--
         --><input type="radio" name="sort" value="title" id="title">
        </form>

        <section>
            <?php include 'searchFunctions.php'; ?>
        </section>
    </main>

    <script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.min.js"></script>
    <script src="js/search.js"></script>
</body>