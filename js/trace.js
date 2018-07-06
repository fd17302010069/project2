function tail(i) {
    let cStart=document.cookie.indexOf("trace=");
    if(cStart!==-1){
        cStart+="trace=".length;
        let cEnd=document.cookie.indexOf(";",cStart);
        if (cEnd===-1){
            cEnd=document.cookie.length
        }
        let traceCookie=document.cookie.substring(cStart,cEnd); //截取cookie中trace的内容
        let trace=traceCookie.split("%2B"); //连接符+的转码
        trace.length=i+1;
        traceCookie=trace.join("%2B");
        document.cookie=document.cookie.substring(0,cStart)+traceCookie+document.cookie.substring(cEnd);
    }
}

let traceTag=document.getElementsByClassName("traceTag");
for(let i=0;i<traceTag.length;i++){
    traceTag[i].onclick=function (){
        tail(i);
    }
}