jQuery(window).load(function() {
    jQuery('#featured').orbit({
        animation: 'fade', // fade, horizontal-slide, vertical-slide, horizontal-push
        animationSpeed: 800,// how fast animtions are
        timer: true,  // true or false to have the timer
        resetTimerOnClick: false, // true resets the timer instead of pausing slideshow progress
        advanceSpeed: 4000,  // if timer is enabled, time between transitions 
        pauseOnHover: true, // if you hover pauses the slider
        startClockOnMouseOut: true, // if clock should start on MouseOut
        startClockOnMouseOutAfter: 1000, // how long after MouseOut should the timer start again
        directionalNav: true, // manual advancing directional navs
        captions: true, // do you want captions?
        captionAnimation: 'fade', // fade, slideOpen, none
        captionAnimationSpeed: 800, // if so how quickly should they animate in
        bullets: true, // true or false to activate the bullet navigation
        bulletThumbs: false, // thumbnails for the bullets
        bulletThumbLocation: '', // location from this file where thumbs will be
        afterSlideChange: function(){}, // empty function 
        // Altered jquery Orbit script to pull 16x9 gif from our server instead of relying on PlaceHold.IT
        fluid: '16x9' // or set a aspect ratio for content slides (ex: '4x3') 
    });
});