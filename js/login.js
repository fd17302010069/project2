document.getElementsByClassName("link")[3].className="link current";

let loginForm=document.getElementsByTagName("form")[0];
let username = document.getElementById("username");
let nameError = document.getElementById("name_error");
let password = document.getElementById("password");
let passError = document.getElementById("pass_error");
let captcha = document.getElementById("captcha");
let captchaError = document.getElementById("captcha_error");
let cancel = document.getElementById("cancel");

let flags=[false,false,false];

function checkFlags(flags){
    for(let i=0;i<flags.length;i++){
        if(flags[i]===false){
            return false;
        }
    }
    return true;
}

username.onblur=function () {
    if(username.value===""){
        nameError.innerHTML="*用户名不得为空";
        flags[0]=false;
    }
    else{
        nameError.innerHTML="&emsp;";
        flags[0]=true;
    }
};

password.onblur=function () {
    if(password.value===""){
        passError.innerHTML="*密码不得为空";
        flags[1]=false;
    }
    else{
        passError.innerHTML="&emsp;";
        flags[1]=true;
    }
};

captcha.onblur=function(){
    if(captcha.value===""){
        captchaError.innerHTML="*验证码不得为空";
        flags[2]=false;
    }
    else {
        captchaError.innerHTML="&emsp;";
        flags[2]=true;
    }
};

cancel.onclick=function () {
    window.history.back();
};

function checkAll(){
    for(let i=0;i<loginForm.elements.length;i++){
        loginForm.elements[i].focus();
        loginForm.elements[i].blur();
    }
}

loginForm.onsubmit=function () {
    checkAll();
    if(!checkFlags(flags)){
        return false;
    }
};