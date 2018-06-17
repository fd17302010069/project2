<?php
function generateCartOption($artwork,$cartResult){
    if($artwork["orderID"]!==NULL){
        echo'<span class="disabled_button">Sold Out</span>';
    }
    else{
        if(!isset($_SESSION["userID"])){
            echo'<button disabled title="请登录后进行添加购物车操作"><i class="fas fa-shopping-cart"></i> Add to Shopping Cart</button>';
        }
        else {
            if($artwork["ownerID"]===$_SESSION["userID"]){
                echo'<span class="disabled_button">For sale</span>';
            }
            else{
                $inOthersCart=false;
                $alreadyAdded=false;
                while($row=$cartResult->fetch_assoc()){
                    if($row['userID']===$_SESSION["userID"]){
                        $alreadyAdded=true;
                    }
                    else{
                        $inOthersCart=true;
                    }
                }
                if($alreadyAdded){
                    echo'<span class="disabled_button">Already In Your Cart</span>';
                }
                else{
                    echo'<button><i class="fas fa-shopping-cart"></i> Add to Shopping Cart</button>';
                }
                if($inOthersCart){
                    echo'<i class="fa fa-exclamation-circle" title="已被其他用户加入购物车"></i>';
                }
            }
        }
    }
}
