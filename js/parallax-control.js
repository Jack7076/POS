var banner = document.getElementById('index-banner');

var parallax = new Parallax(banner);

parallax.friction(0.2, 0.2);
parallax.limitY = 0;
parallax.hoverOnly = true;

var blinkstatus = true;
var blinkrate = 300;
blink = () => {
    if(blinkstatus){
        $("#blink-block").fadeOut(blinkrate);
    } else {
        $("#blink-block").fadeIn(blinkrate);
    }
    blinkstatus = !blinkstatus;
}

setInterval(blink, blinkrate);

// cycleImages = () => {
//     var images = $('.imagecycle'),
//         now = images.filter(':visible'),
//         next = now.next().length ? now.next() : images.first(),
//         speed = 1000;

//     now.fadeOut(speed);
//     next.fadeIn(speed);
//     console.log("Cycle");
// }

// setInterval(cycleImages, 1400);