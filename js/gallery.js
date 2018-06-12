function doFadeOut(num) {
    let gallery=document.getElementsByClassName("gallery")[num];
    $(gallery).fadeOut(1000);
    $(gallery).className="gallery none";
}
function doFadeIn(num) {
    let gallery=document.getElementsByClassName("gallery")[num];
    $(gallery).fadeIn(500);
    $(gallery).className="gallery";
}
function changeCount(count) {
    count++;
    if(count >= 3){
        count = 0;
    }
    return count;
}
function changeImg() {
    count=changeCount(count);
    doFadeIn(count);
    setTimeout("doFadeOut(count)",3000);
}

let count=0;
$(function () {
    setTimeout("doFadeOut(count)",3000);
    setInterval("changeImg()",4500);
});