document.getElementsByClassName("link")[4].className="link current";

let registerForm=document.getElementsByTagName("form")[0];

let username = document.getElementById("username");
let password = document.getElementById("password");
let passwordAgain = document.getElementById("password_again");
let email = document.getElementById("email");
let phone = document.getElementById("phone");
let address = document.getElementById("address");

let nameError = document.getElementById("name_error");
let passError = document.getElementById("pass_error");
let passAgainError = document.getElementById("pass_again_error");
let emailError = document.getElementById("email_error");
let phoneError = document.getElementById("phone_error");
let addressError = document.getElementById("address_error");

let cancel = document.getElementById("cancel");

let flags=[false,false,false,false,false,false];
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
        nameError.innerHTML="*昵称不得为空";
        flags[0]=false;
    }
    else if(!username.value.match(new RegExp(".{6,}","g"))){
        nameError.innerHTML="*格式错误！至少为6位。正确示例：qwe123";
        flags[0]=false;
    }
    else if(!username.value.match(new RegExp("[^A-Za-z]+","g"))){
        nameError.innerHTML="*格式错误！不能为纯字母。正确示例：qwe123";
        flags[0]=false;
    }
    else if(!username.value.match(new RegExp("[^0-9]","g"))){
        nameError.innerHTML="*格式错误！不能为纯数字。正确示例：qwe123";
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
    else if(!password.value.match(new RegExp(".{6,}","g"))){
        passError.innerHTML="*格式错误！至少为6位。正确示例：12345a";
        flags[1]=false;
    }
    else if(!password.value.match(new RegExp("[^0-9]","g"))){
        passError.innerHTML="*格式错误！不能为纯数字。正确示例：12345a";
        flags[1]=false;
    }
    else if(password.value===username.value){
        passError.innerHTML="*格式错误！不能与用户名相同";
        flags[1]=false;
    }
    else{
        passError.innerHTML="&emsp;";
        flags[1]=true;
    }
};

passwordAgain.onblur=function () {
    if(passwordAgain.value===""){
        passAgainError.innerHTML="*确认密码不得为空";
        flags[2]=false;
    }
    else if(passwordAgain.value!==password.value){
        passAgainError.innerHTML="*错误！确认密码与密码不同";
        flags[2]=false;
    }
    else{
        passAgainError.innerHTML="&emsp;";
        flags[2]=true;
    }
};

email.onblur =function () {
    if(email.value===""){
        emailError.innerHTML="*邮箱不得为空";
        flags[3]=false;
    }
    else if(!email.value.match(new RegExp(".+@.+\\.[A-Za-z]+","g"))){
        emailError.innerHTML="*格式错误！正确示例：user@email.com";
        flags[3]=false;
    }
    else{
        emailError.innerHTML="&emsp;";
        flags[3]=true;
    }
};

phone.onblur =function () {
    if(phone.value===""){
        phoneError.innerHTML="*电话不得为空";
        flags[4]=false;
    }
    else if(phone.value.match(new RegExp("[^0-9]","g"))){
        phoneError.innerHTML="*格式错误！正确示例：13312345678";
        flags[4]=false;
    }
    else{
        phoneError.innerHTML="&emsp;";
        flags[4]=true;
    }
};

address.onblur=function () {
    if(address.value===""){
        addressError.innerHTML="*地址不得为空";
        flags[5]=false;
    }
    else{
        addressError.innerHTML="&emsp;";
        flags[5]=true;
    }
};

cancel.onclick=function () {
    window.history.back();
};

function checkAll(){
    for(let i=0;i<registerForm.elements.length;i++){
        registerForm.elements[i].focus();
        registerForm.elements[i].blur();
    }
}

registerForm.onsubmit=function () {
    checkAll();
    if(!checkFlags(flags)){
        return false;
    }
};