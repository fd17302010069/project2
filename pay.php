<?php
if(isset($_POST["sum_price"])&&isset($_POST["user_balance"])){
    if((int)($_POST["user_balance"]) < (int)($_POST["sum_price"])){
        myAlert("余额不足！");
    }
}