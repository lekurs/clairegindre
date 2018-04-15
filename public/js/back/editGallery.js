// jQuery(document).ready(function($) {

    // var thumb = $('.picture-thumb');

    var draggrable = function(element) {
        var rect;
        this.element            = element;
        this.items                 = this.element.querySelectorAll(this.element.dataset.sortable);
        rect                            = this.items[0].getBoundingClientRect();
        this.items_width    = Math.floor(rect.width);
        this.items_height   = Math.floor(rect.height);
        this.cols                    = Math.floor(this.element.offsetWidth / this.items_width);
        this.element.style.height = (this.items_height  * Math.ceil(this.items.length / this.cols)) + "px";
        console.log(this.element.offsetWidth);
        console.log(this.items_width);
        console.log(this.element.offsetWidth / this.items_width);

        for(var i = 0; i < this.items.length; i++) {
            var item       = this.items[i];
            var position = item.dataset.position;
            var x              = this.items_width * (position % this.cols);
            var y              = this.items_height * Math.floor(position / this.cols);

            console.log(position);
            console.log(y);

            item.style.position = "absolute";
            item.style.top          = "0px";
            item.style.left         = "0px";
            item.style.transform = "translate3D(" + x + "px, " + y + "px, 0)";
        }
    }
// })