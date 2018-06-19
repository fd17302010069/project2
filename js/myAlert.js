let okButton = document.getElementsByClassName("okButton")[0];
if(okButton !== undefined){
    okButton.onclick=function () {
        // let alert=document.getElementsByClassName("shield")[0];
        // alert.className="close";
        window.history.go(-1);
    };
}

//这个可能用不上了
function myJsAlert(notice,haveOKButton=true) {
    let shield=document.createElement("div");
    shield.className="shield";
    let alertContent=document.createElement("div");
    alertContent.className="alert_content";
    let alertHeader=document.createElement("div");
    alertHeader.className="alert_header";
    alertHeader.innerText="提示";
    let alertBody=document.createElement("div");
    alertBody.className="alert_body";
    alertBody.innerText=notice;
    let alertFooter=document.createElement("div");
    alertFooter.className="alert_footer";
    if(haveOKButton){
        let okButton=document.createElement("button");
        okButton.className="okButton";
        okButton.type="button";
        okButton.innerText="确认";
        alertFooter.appendChild(okButton);
    }
    else{
        alertFooter.innerText="请等待页面跳转......";
    }
    alertContent.appendChild(alertHeader);
    alertContent.appendChild(alertBody);
    alertContent.appendChild(alertFooter);
    shield.appendChild(alertContent);
    return shield;
}