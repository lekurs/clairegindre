//Move Picture on Gallery to change position
    var Sortable = function(element, scrollable) {
        var self                      = this;
        if(scrollable == null) {
            scrollable = document.body;
        }
        this.scrollable = scrollable;
        this.element            = element;
        this.items                 = this.element.querySelectorAll(this.element.dataset.sortable);
        this.setPositions();
        window.addEventListener('resize', function () {
            self.setPositions();
        });

    interact(this.element.dataset.sortable, {
        context: this.element
    }).draggable({
        inertia: false,
        manualStart: false,
        autoScroll:  {
            container: scrollable,
            margin: 150,
            speed: 600
        },
        onmove: function (e) {
            self.move(e);
        }
    }).on('dragstart', function (e) {
        var rect = e.target.getBoundingClientRect();
        e.target.classList.add('is-dragged');
        self.startPosition = e.target.dataset.position;
        self.offset = {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top,
        };
        self.scrollTopStart = self.scrollable.scrollTop;
    }).on('dragend', function (e) {
        e.target.classList.remove('is-dragged');
        self.moveItem(e.target, e.target.dataset.position);
        self.sendValues();
    })
};

Sortable.prototype.setPositions = function() {

    var rect                            = this.items[0].getBoundingClientRect();
    this.items_width    = Math.floor(rect.width);
    this.items_height   = Math.floor(rect.height);
    this.cols                    = Math.floor(this.element.offsetWidth / this.items_width);
    this.element.style.height = (this.items_height  * Math.ceil(this.items.length / this.cols)) + "px";

    for(var i = 0; i < this.items.length; i++) {
        var item       = this.items[i];

        item.style.position = "absolute";
        item.style.top          = "0px";
        item.style.left         = "0px";

        this.moveItem(item, item.dataset.position);
    }
}

Sortable.prototype.move = function (e) {
    var p = this.getXY(this.startPosition); // ?
    var x = p.x + e.clientX - e.clientX0;
    var y = p.y + e.clientY - e.clientY0 + this.scrollable.scrollTop - this.scrollTopStart;
    e.target.style.transform = "translate3D(" + x + "px, " + y + "px, 0)";

    var oldPosition = e.target.dataset.position;
    var newPosition = this.guessPosition(x + this.offset.x, y + this.offset.y);

    if(oldPosition != newPosition) {
        this.swap(oldPosition, newPosition);
        e.target.dataset.position = newPosition;
    }
    this.guessPosition(x, y);
};

Sortable.prototype.getXY = function (position) {
    var x = this.items_width * (position % this.cols);
    var y = this.items_height * Math.floor(position / this.cols);
    return {
        x: x,
        y: y
    }
};

Sortable.prototype.guessPosition = function (x, y) {
   var col = Math.floor(x / this.items_width);
   if(col >= this.cols){
       col = this.cols - 1;
   }
   if(col <= 0) {
       col = 0;
   }
   var row = Math.floor(y / this.items_height);
   if(row < 0) {
       row = 0;
   }
   var position = col + row * this.cols;

   if(position >= this.items.length) {
       return this.items.length - 1;
   }
   return position;
};

Sortable.prototype.swap = function (startPosition, endPosition) {
    for(var i = 0; i < this.items.length; i++) {
        var item = this.items[i];
        if(!item.classList.contains('is-dragged')) {
            var position = parseInt(item.dataset.position, 10);
                if(position >= endPosition && position < startPosition && endPosition < startPosition) {
                    this.moveItem(item, position + 1);
                } else if(position <= endPosition && position > startPosition && endPosition > startPosition) {
                    this.moveItem(item, position - 1);
                }
        }
    }
};

Sortable.prototype.moveItem = function (item, position) {
   var p = this.getXY(position);
    item.style.transform = "translate3D(" + p.x + "px, " + p.y + "px, 0)";
    item.dataset.position = position;
};

Sortable.prototype.sendValues = function () {
   for (i = 0; i < this.items.length; i++) {
        var item = this.items[i];
        var hiddenType = document.getElementById("gallery_order_pictures_"+i+"_displayOrder");
        hiddenType.value= item.dataset.position;
   }
};