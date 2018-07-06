<?php
function getTitle($url){
    $url=explode("/",$url)[2];
    $url=explode(".",$url)[0];
    switch ($url){
        case "detail":
            return "商品详情";
            break;
        case "search":
            return "搜索";
            break;
        case "userInfo":
            return "个人信息";
            break;
        case "shoppingCart":
            return "购物车";
            break;
        case "launch":
            return "发布艺术品";
            break;
        default:
            return "";
    }
}