document.getElementsByClassName("link")[4].className="link current";

let launchForm=document.getElementsByClassName("launch")[0];
let title=document.getElementById("art_title");
let artist=document.getElementById("art_artist");
let description=document.getElementById("art_description");
let year=document.getElementById("year");
let genre=document.getElementById("genre");
let height=document.getElementById("height");
let width=document.getElementById("width");
let price=document.getElementById("price");
let file=document.getElementById("file");
let error=document.getElementsByClassName("error");

let flags=[false,false,false,false,false,false,false,false,false];
function checkFlags(flags){
    for(let i=0;i<flags.length;i++){
        if(flags[i]===false){
            return false;
        }
    }
    return true;
}

title.onblur=function () {
    if(title.value===""){
        error[0].innerHTML="*艺术品名称不能为空";
        flags[0]=false;
    }
    else{
        error[0].innerHTML="&emsp;";
        flags[0]=true;
    }
};
artist.onblur=function (){
    if(artist.value===""){
        error[1].innerHTML="*作者名不能为空";
        flags[1]=false;
    }
    else{
        error[1].innerHTML="&emsp;";
        flags[1]=true;
    }
};
description.onblur=function (){
    if(description.value===""){
        error[2].innerHTML="*简介不能为空";
        flags[2]=false;
    }
    else{
        error[2].innerHTML="&emsp;";
        flags[2]=true;
    }
};
year.onblur=function () {
    if(/^-?\d+$/.test(year.value) && year.value!=="0"){
        if(parseInt(year.value)<=new Date().getFullYear()&&parseInt(year.value)>-5000){
            error[3].innerHTML="&emsp;";
            flags[3]=true;
        }
        else{
            error[3].innerHTML="*请输入正确的年份";
            flags[3]=false;
        }
    }
    else{
        error[3].innerHTML="*请输入正确的年份";
        flags[3]=false;
    }
};
genre.onblur=function (){
    if(genre.value===""){
        error[4].innerHTML="*流派不能为空";
        flags[4]=false;
    }
    else{
        error[4].innerHTML="&emsp;";
        flags[4]=true;
    }
};
height.onblur=function () {
    if(/^\d+\.?\d*$/.test(height.value) && parseFloat(height.value)>0){
        if(/^\d+\.?\d{0,2}$/.test(height.value)){
            error[5].innerHTML="&emsp;";
            flags[5]=true;
        }
        else{
            error[5].innerHTML="*长度请保留两位小数";
            flags[5]=false;
        }
    }
    else{
        error[5].innerHTML="*请输入正确的长度";
        flags[5]=false;
    }
};
width.onblur=function () {
    if(/^\d+\.?\d*$/.test(width.value) && parseFloat(width.value)>0){
        if(/^\d+\.?\d{0,2}$/.test(width.value)) {
            error[6].innerHTML = "&emsp;";
            flags[6]=true;
        }
        else{
            error[6].innerHTML="*宽度请保留两位小数";
            flags[6]=false;
        }
    }
    else{
        error[6].innerHTML="*请输入正确的宽度";
        flags[6]=false;
    }
};
price.onblur=function () {
    if(/^\d+$/.test(price.value) && parseInt(price.value)>0){
        error[7].innerHTML="&emsp;";
        flags[7]=true;
    }
    else{
        error[7].innerHTML="*请输入正确的价格";
        flags[7]=false;
    }
};

file.onchange=function () {
    if(this.files[0]!==undefined && /image\/\w+/.test(this.files[0].type)){
        document.getElementById("img_preview").src = window.URL.createObjectURL(this.files[0]);
        error[8].innerHTML="";
        flags[8]=true;
    }
    else{
        document.getElementById("img_preview").src = "";
        error[8].innerHTML="*请上传图片文件";
        flags[8]=false;
    }
};

function checkAll(){
    for(let i=0;i<launchForm.elements.length;i++){
        launchForm.elements[i].focus();
        launchForm.elements[i].blur();
    }
}

launchForm.onsubmit=function () {
    checkAll();
    if(!checkFlags(flags)){
        return false;
    }
};