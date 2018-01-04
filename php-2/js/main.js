$(function () {

    function Slider() {
        this.images = $(".slider img");
        this.btnPrev = $(".slider .prev");
        this.btnNext = $(".slider .next");

        var i = 0;

        // var slider = this;

        this.prev = function () {
            slider.images[i].classList.remove('showed');
            i--;

            if (i < 0) {
                i = slider.images.length - 1;
            }

            slider.images[i].classList.add('showed');
        };

        this.next = function () {
            slider.images[i].classList.remove('showed');
            i++;

            if (i >= slider.images.length) {
                i = 0;
            }

            slider.images[i].classList.add('showed');
        };

        document.querySelector(slider.btnPrev).onclick = slider.prev;
        document.querySelector(slider.btnNext).onclick = slider.next;
    }

    var slider = new Slider();

});