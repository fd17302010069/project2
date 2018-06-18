document.getElementsByClassName("link")[2].className="link current";

function searchArtist() {
    document.getElementById("search_by_artist").submit();
}

let addBtn=document.getElementById("add");
if(addBtn !== null && addBtn!==undefined){
    addBtn.onclick=function () {
        document.getElementById("cart_info").submit();
    }
}