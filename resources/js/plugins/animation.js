$(document).ready(function() {
    animate.init();
});

var animate = {

    init: function() {
        var setup = this.setup;
        setup.animateEvents();
    },

    setup: {

        animateEvents: function() {



            // Init ScrollMagic
            var controller = new ScrollMagic.Controller();

            /** 
             * GENERAL : ANIMATIONS
             */

            $('.slideUp').each(function() {
                var tl = new TimelineMax()
                .fromTo(this, 0.50,
                    { y: "20px", opacity: 0, ease:Power0.easeIn },
                    { y: "0px", opacity: 1, ease:Power0.easeIn })

                var fadeScene = new ScrollMagic.Scene({
                    triggerElement: this,
                    triggerHook: .8,
                    reverse:false,
                    })
                    .setTween(tl)
                    .addTo(controller);
            });

            $('.slideDown').each(function() {
                var tl = new TimelineMax()
                .fromTo(this, 0.50,
                    { y: "-20px", opacity: 0, ease:Power0.easeIn },
                    { y: "0px", opacity: 1, ease:Power0.easeIn })

                var fadeScene = new ScrollMagic.Scene({
                    triggerElement: this,
                    triggerHook: .8,
                    reverse:false,
                    })
                    .setTween(tl)
                    .addTo(controller);
            });

             $('.slideRight').each(function() {
                var tl = new TimelineMax()
                .fromTo(this, 0.50,
                    { x: "-20px", opacity: 0, ease:Power0.easeIn },
                    { x: "0px", opacity: 1, ease:Power0.easeIn })

                var fadeScene = new ScrollMagic.Scene({
                    triggerElement: this,
                    triggerHook: .8,
                    reverse:false,
                    })
                    .setTween(tl)
                    .addTo(controller);
            });

             $('.slideLeft').each(function() {
                var tl = new TimelineMax()
                .fromTo(this, 0.50,
                    { x: "20px", opacity: 0, ease:Power0.easeIn },
                    { x: "0px", opacity: 1, ease:Power0.easeIn })

                var fadeScene = new ScrollMagic.Scene({
                    triggerElement: this,
                    triggerHook: .8,
                    reverse:false,
                    })
                    .setTween(tl)
                    .addTo(controller);
            });

             $('.fadeIn').each(function() {
                var tl = new TimelineMax()
                .fromTo(this, 1,
                    { x: "0px", opacity: 0, ease:Power0.easeIn },
                    { x: "0px", opacity: 1, ease:Power0.easeIn })

                var fadeScene = new ScrollMagic.Scene({
                    triggerElement: this,
                    triggerHook: .8,
                    reverse:false,
                    })
                    .setTween(tl)
                    .addTo(controller);
            });
            

        },
        
    },
}