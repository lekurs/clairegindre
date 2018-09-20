const form = document.querySelector("form");
const inputs = document.getElementsByTagName("input");
const faElt = document.createElement("i");
const faCrossElt = document.createElement("i");


for (var i=0; i<inputs.length; i++) {
    inputs[i].addEventListener("input", function (e) {
        this.after(spanElt);
        this.after(faElt);

        let value = e.target.value;

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