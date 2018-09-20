var form = document.querySelector("form");
var inputs = document.getElementsByTagName("input");
var faElt = document.createElement("i");
var faCrossElt = document.createElement("i");

console.log("test");


for (var i=0; i<inputs.length; i++) {
    inputs[i].addEventListener("input", function (e) {
        this.after(spanElt);
        this.after(faElt);

        var value = e.target.value;

        if (value.length >= 4) {
            faElt.className = 'fa fa-check';
            faElt.textContent = "";
            faElt.style.color = "#5f6b67";
            faCrossElt.remove();
        } else {
            faCrossElt.className = "fa fa-times-circle";
            faCrossElt.textContent = "";
            faCrossElt.style.color = "red";
        }
    });
}