document.getElementsByClassName("link")[4].className="link current";

document.getElementById("file").onchange=function () {
    document.getElementById("img_preview").src = window.URL.createObjectURL(this.files[0]);
};
