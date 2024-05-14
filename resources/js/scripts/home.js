export const home = {
	init() {
		console.log('home')
		function changeHeader() {
			var window_top = $(window).scrollTop();
			var trigger__top = $('.frame1').offset().top;
			
			if (window_top > trigger__top) {
				$('header').removeClass('changeHeader');
			} else {
				$('header').addClass('changeHeader');
			}
		}

		$(function() {
			$(window).scroll(changeHeader);
			changeHeader();
		});

		$('.navbar-toggler').on('click', function(){
			if ($('.navbar-toggler').hasClass('collapsed')) {
				$('header').removeClass('changeHeader');
			} else {
				changeHeader();
			}
		});

		// $('.datapicker').datepicker({
		// 	autoclose: true,
		// 	minDate: 0
		// })

		$(".hm-fr3__sliderCon").on('init', function(event, slick){
			setTimeout(function(){
				$(".twentytwenty-container").twentytwenty();
			}, 500);
			
		});

		$(".hm-fr3__sliderCon").slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			draggable: false,
			swipeToSlide: false,
			touchMove: false
		});

		$(".hm-fr4__sliderCon").slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			centerMode: true,
			adaptiveHeight: true
		});

		$(".hm-fr6__sliderCon").slick({
			dots: false,
			arrows: true,
			infinite: false,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						arrows: false,
						slidesToShow: 3,
						slidesToScroll: 3,
					}
				},
				{
					breakpoint: 769,
					settings: {
						arrows: false,
						slidesToShow: 2,
						slidesToScroll: 2,
					}
				},
				{
					breakpoint: 481,
					settings: {
						arrows: false,
						slidesToShow: 1,
						slidesToScroll: 1,
					}
				}
			]
		});

		$(".hm-fr7__sliderConFor").slick({
			dots: false,
			arrows: false,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 2000,
			asNavFor: '.hm-fr7__sliderCon'
		});

		$(".hm-fr7__sliderCon").slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 2000,
			adaptiveHeight: true,
			focusOnSelect: false,
			asNavFor: '.hm-fr7__sliderConFor',
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						arrows: false,
						slidesToShow: 3,
						slidesToScroll: 3,
					}
				},
				{
					breakpoint: 769,
					settings: {
						arrows: false,
						slidesToShow: 2,
						slidesToScroll: 2,
					}
				}
			]
		});

		$(".hm-fr9__sliderCon").slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 6,
			slidesToScroll: 6,
			autoplay: true,
			autoplaySpeed: 3000,
			responsive: [
				{
					breakpoint: 1281,
					settings: {
						slidesToShow: 5,
						slidesToScroll: 5,
					}
				},
				{
					breakpoint: 1025,
					settings: {
						arrows: false,
						slidesToShow: 4,
						slidesToScroll: 4,
					}
				},
				{
					breakpoint: 769,
					settings: {
						arrows: false,
						slidesToShow: 3,
						slidesToScroll: 3,
					}
				},
				{
					breakpoint: 481,
					settings: {
						arrows: false,
						slidesToShow: 2,
						slidesToScroll: 2,
					}
				}
			]
		});

		// newsheight();
		// $('.hm-fr8__newsCon.active .hm-fr8__textCon').addClass('limit');

		// $('.hm-fr8__newsList').on('click', function(){
		// 	$('.hm-fr8__newsList').removeClass('active');
		// 	$(this).addClass('active');
		// 	var target = $(this).data('id');

		// 	$('.hm-fr8__newsCon').removeClass('active');
		// 	$('.hm-fr8__newsCon .hm-fr8__textCon').removeClass('limit');
		// 	$('.hm-fr8__newsCon .hm-fr8__textCon').removeAttr('style');
		// 	$('.hm-fr8__newsCon[data-target="' + target + '"]').addClass('active');
		// 	$('.hm-fr8__newsCon.active .hm-fr8__textCon').addClass('limit');
		// 	$('.hm-fr8__newsCon.active button').fadeIn(300);
		// 	newsheight();
		// })

		function newsheight() {
			var hmHeight = $('.hm-fr8__newsCon.active .hm-fr8__text').height();
			return hmHeight;
		}
		
		$('.hm-fr8__newsCon button').on('click', function(){
			var adjustHeight = newsheight();
			$('.hm-fr8__newsCon.active .hm-fr8__textCon').css('max-height', adjustHeight);
			$(this).fadeOut(300);
		});


		//Calls the function on load to switch layout
		toMobile();

		//Calls the function on resize to switch layout
		window.addEventListener("resize", toMobile);
		function toMobile(){
			var width = $(window).width(); 
			if (width <= 1024){
				$(document).ready(function(){
					$('.hm-fr5__gridParent').slick({
						dots: true,
						arrows: false,
						slidesToShow: 2,
						slidesToScroll: 2,
						adaptiveHeight: true,
						responsive: [
							{
								breakpoint: 769,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
								}
							}
						]
					});

					$('.hm-fr6__sliderCon').slick({
						dots: true,
						arrows: false,
						slidesToShow: 2,
						slidesToScroll: 2,
						adaptiveHeight: true,
						responsive: [
							{
								breakpoint: 769,
								settings: {
									slidesToShow: 1,
									slidesToScroll: 1,
								}
							}
						]
					});
				})
			} else {
				var clicked = false, clickX;
				$('.hm-fr6').on({
					'mousemove': function(e) {
						clicked && updateScrollPos(e);
					},
					'mousedown': function(e) {
						e.preventDefault();
						clicked = true;
						clickX = e.pageX;
					},
					'mouseup': function() {
						clicked = false;
						$('.hm-fr6__sliderCon').css('cursor', 'auto');
					}
				});

				var updateScrollPos = function(e) {
					$('.hm-fr6__sliderCon').css('cursor', 'grabbing');
					$('.hm-fr6__sliderCon').scrollLeft($('.hm-fr6__sliderCon').scrollLeft() + (clickX - e.pageX));
				}
			}
		};

		var controller = new ScrollMagic.Controller();

		$('.hm-fr5__gridParent').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".hm-fr5__gridChild", 1, {opacity:0}, 0.3,)
			.staggerTo(".hm-fr5__gridChild", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.hm-fr6__sliderCon').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".hm-fr6__sliderList", 1, {opacity:0}, 0.3,)
			.staggerTo(".hm-fr6__sliderList", 1, {opacity:1}, 0.3,)

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