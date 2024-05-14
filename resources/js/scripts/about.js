export const about = {
	init() {
		$(".about-fr3__sliderCon").slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			centerMode: true
		});

		var controller = new ScrollMagic.Controller();

		$('.about-fr3__gridParent').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".about-fr3__gridChild", 1, {opacity:0}, 0.3,)
			.staggerTo(".about-fr3__gridChild", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});
	},
}