<?php
    if(isset($_POST['search'])&&isset($_POST['search_option'])){
        $searchValue=$_POST['search'];
        $searchOptionChecked[]=in_array("title",$_POST['search_option'])?"checked":"";
        $searchOptionChecked[]=(boolean)in_array("description",$_POST['search_option'])?"checked":"";
        $searchOptionChecked[]=(boolean)in_array("artist",$_POST['search_option'])?"checked":"";
    }
    else{
        $searchValue="";
        $searchOptionChecked=array("checked","checked","checked");
    }
?>

<header>
    <h1>Art Store</h1>
    <form id="search_form" action="search.php" method="post">
        <input type="search" name="search" id="search" value="<?php echo $searchValue?>">
        <label for="search"><input type="submit" value="搜索" id="go_search"></label>
        <div id="option_bar">
            <label for="title">名称</label><!--
         --><input type="checkbox" name="search_option[]" value="title" id="title" <?php echo $searchOptionChecked[0]?>>
            <label for="description">简介</label><!--
         --><input type="checkbox" name="search_option[]" value="description" id="description" <?php echo $searchOptionChecked[1]?>>
            <label for="artist">作者</label><!--
         --><input type="checkbox" name="search_option[]" value="artist" id="artist" <?php echo $searchOptionChecked[2]?>>
        </div>
    </form>
</header>