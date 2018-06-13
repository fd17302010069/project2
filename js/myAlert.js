let okButton = document.getElementsByClassName("okButton")[0];
if(okButton !== undefined){
    okButton.onclick=function () {
        let alert=document.getElementsByClassName("shield")[0];
        alert.className="close";
    };
}