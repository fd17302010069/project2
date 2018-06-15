document.getElementsByClassName("link")[5].className="link current";

function payOrder() {
    let sumPrice=document.getElementsByName("sum_price")[0].value;
    let userBalance=document.getElementsByName("user_balance")[0].value;
    if(userBalance<sumPrice){

    }
}

// document.getElementsByTagName("body")[0].appendChild(myJsAlert("余额不足！"));