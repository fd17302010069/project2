document.getElementsByClassName("link")[1].className="link current";

document.getElementById("search_form").onsubmit = function () {
    if(document.getElementById("search").value===""){
        return false;
    }
    let options=document.getElementsByName("search_option[]");
    let flag=false;
    for(let i=0;i<options.length;i++){
        if(options[i].checked===true){
            flag=true;
        }
    }
    if(!flag){
        return false;
    }
};

function getOptionValue(){
    let options=document.getElementsByName("search_option[]");
    let optionValue=[];
    for(let i=0;i<options.length;i++){
        if(options[i].checked===true){
            optionValue.push(options[i].value);
        }
    }
    return optionValue;
}

$(":radio").change(function () {
    $("section").load("searchFunctions.php",
        {search:$("#search").val(),
        search_option:getOptionValue(),
        sort:$("input[name='sort']:checked").val()
        });
});