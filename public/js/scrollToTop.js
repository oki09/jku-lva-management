const $btn = $('#toTheTopBtn');

window.onscroll = function () {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        $btn.show();
    } else {
        $btn.hide();
    }
};

$btn.on('click', function () {
    // this changes the scrolling behavior to "smooth"
    window.scrollTo({top: 0, behavior: 'smooth'});
});
