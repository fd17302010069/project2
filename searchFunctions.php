<?php
$mysqli = new mysqli("localhost","root","","art");

if(isset($_POST['search'])&&isset($_POST['search_option'])){
    $searchKey=$_POST['search'];
    $searchOption=$_POST['search_option'];
    $sql="SELECT * FROM artworks";
    switch (count($searchOption)){
        case 1:
            $sql.=" WHERE $searchOption[0] like '%$searchKey%'";
            break;
        case 2:
            $sql.=" WHERE $searchOption[0] like '%$searchKey%' OR $searchOption[1] like '%$searchKey%'";
            break;
        case 3:
            $sql.=" WHERE $searchOption[0] like '%$searchKey%' OR $searchOption[1] like '%$searchKey%' OR $searchOption[2] like '%$searchKey%'";
            break;
    }//根据用户选择的条件筛选

    if(isset($_POST['sort'])){
        $sql.=" ORDER BY {$_POST['sort']}";
    }//排序

    $searchResult=$mysqli->query($sql);

    if($searchResult){
        $totalCount=$searchResult->num_rows;
    }
    else{
        $totalCount=0;
    }

    if($totalCount===0){
        echo'<p class="hint">没有相关的搜索结果</p>';
    }
    else{
        $pageSize=10;
        $totalPage=(int)(($totalCount % $pageSize===0) ? ($totalCount/$pageSize) : ($totalCount/$pageSize+1));

        if(!isset($_POST['page'])){
            $currentPage=1;
        }
        else{
            $currentPage=$_POST['page'];
        }

        $mark=($currentPage-1)*$pageSize;
        $firstPage=1;
        $lastPage=$totalPage;
        $prePage=($currentPage>1)?($currentPage-1):1;
        $nextPage=($currentPage<$totalPage)?($currentPage+1):$totalPage;

        $sql.=" LIMIT ".$mark.",".$pageSize;
        $searchResult=$mysqli->query($sql);

        while($row=$searchResult->fetch_assoc()){
            if(mb_strlen($row["description"])>300){
                $row["description"]=mb_substr($row["description"],0,300,"UTF8")."...";
            }
            ?>
            <div class="search_result">
                <img src="img/<?php echo $row["imageFileName"]?>" alt="<?php echo $row["title"]?>" width="150" height="150">
                <h3><?php echo $row["title"]?></h3>
                <p class="artist"><?php echo $row["artist"]?></p>
                <p class="intro"><?php echo $row["description"]?></p>
                <p>
                    <span class="view_detail"><a href="detail.php?id=<?php echo $row["artworkID"]?>">查看详情</a></span><!--
                             --><span class="detail">价格：<?php echo $row["price"]?></span><!--
                             --><span class="detail">热度：<?php echo $row["view"]?></span>
                </p>
            </div>
            <?php
        }
        ?>
        <div id="page">
            <span class="page_btn">首页</span>
            <span class="page_btn">上一页</span>
            <span class="page_btn">下一页</span>
            <span class="page_btn">尾页</span>
            第<input type="number" value="<?php echo $currentPage?>">页/共<?php echo $totalPage?>页
        </div>
        <?php
    }


}
?>