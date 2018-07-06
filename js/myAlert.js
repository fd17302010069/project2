let okButton = document.getElementsByClassName("okButton")[0];
if(okButton !== undefined){
    okButton.onclick=function () {
        window.history.go(-1);
    };
}