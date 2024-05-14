export const setup = {
	init() {

		//Calls the function on load to switch layout
		headerMobile();

		//Calls the function on resize to switch layout
		window.addEventListener("resize", headerMobile);
		function headerMobile(){
			var width = $(window).width(); 
			if (width <= 991){

				$(document).ready(function(){
					$('.navbar-toggler').fadeIn().addClass('collapsed');
					$('header').removeClass('desktop');
				})

				$('.nav-item').on('click', function(){

					if ($(this).hasClass("active")){
						$(this).removeClass('active');
						
						$(this).find(".nav-sub").slideUp(300);
						$(this).find(".nav-link").removeClass('focus');
					} else {
						$(this).addClass('active');

						$(this).find(".nav-sub").slideDown(300);
						$(this).find(".nav-link").addClass('focus');
					}
				});

				$('.navbar-toggler').on('click', function(){
					if ($('.navbar-toggler').hasClass('collapsed')) {
						$('header').addClass('active');
					} else {
						$('header').removeClass('active');
					}
				});

				$('.ftr__midCon h6.to-mob').on('click', function(){
					if ($(this).hasClass("active")){
						$(this).removeClass('active');
						
						$('.ftr__midCon ul').slideUp(300);
						$(this).removeClass('focus');
					} else {
						$(this).addClass('active');

						$('.ftr__midCon ul').slideDown(300);
						$(this).addClass('focus');
					}
				});

				$('.event-fr5__logoCon').slick({
					dots: true,
					arrows: false,
					slidesToShow: 4,
					slidesToScroll: 4,
					adaptiveHeight: true,
					responsive: [
						{
							breakpoint: 769,
							settings: {
								slidesToShow: 3,
								slidesToScroll: 3,
							}
						},
						{
							breakpoint: 481,
							settings: {
								slidesToShow: 2,
								slidesToScroll: 2,
							}
						}
					]
				});

				$('.reservation-fr1__stepCon').slick({
					dots: false,
					arrows: false,
					slidesToShow: 3,
					slidesToScroll: 1,
					infinite: false,
					centerMode: true
				});

				$('.reservation-fr1__stepCon')
					.on('afterChange init', function(event, slick, direction){
						// console.log('afterChange/init', event, slick, slick.$slides);
						// remove all prev/next
						slick.$slides.removeClass('prevSlide').removeClass('nextSlide');

						// find current slide
						for (var i = 0; i < slick.$slides.length; i++)
						{
					    	var $slide = $(slick.$slides[i]);
							if ($slide.hasClass('slick-current')) {
								// update DOM siblings
								$slide.addClass('active');
								$slide.prev().addClass('prevSlide');
								$slide.next().addClass('nextSlide').removeClass('active');;
								break;
							}
						}
					  }
					)
					.on('beforeChange', function(event, slick) {
					    // optional, but cleaner maybe
					    // remove all prev/next
					    slick.$slides.removeClass('prevSlide').removeClass('nextSlide');
					})
			} else {
				$('header').addClass('desktop');
				// var target = '.nav-item'

				// $(target).on('click', function(){

				// 	if ($(this).hasClass("active")){
				// 		menuClose()
				// 	} else {
				// 		menuClose()

				// 		$(this).addClass('active');

				// 		$(this).find(".nav-sub").slideDown(300);
				// 		$(this).find(".nav-link").addClass('focus');
				// 	}
				// });

				// $(document).mouseup(e => {
				// 	if (!$(target).is(e.target)
				// 	&& $(target).has(e.target).length === 0)
				// 	{
				// 		menuClose()
				// 	}
				// });

				// function menuClose() {
				// 	$(target).removeClass('active');
								
				// 	$(target).find(".nav-sub").slideUp(300);
				// 	$(target).find(".nav-link").removeClass('focus');
				// }

				// $(document).on('mouseup', function(e){
				// 	if ($(e.target).closest(".nav-sub").length === 0) { 
				// 		console.log('outside')

				// 		setTimeout(function(){
				// 			if ($('.nav-item').hasClass("active")){
								
				// 			}
				// 		}, 300);
				// 	}
				// })
			}
		};

		$(".about-fr3__sliderCon").slick({
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


		$(".area-fr2__sliderCon").slick({
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


		var numSlick = 0;
		$('.beyond-fr1__sliderCon').each( function() {
			numSlick++;
			$(this).addClass( 'slider-' + numSlick ).slick({
				dots: true,
				arrows: false,
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				autoplaySpeed: 5000,	
				/*asNavFor: '.beyond-fr1__sliderThumbCon.slider-' + numSlick*/
			});
		});

		numSlick = 0;
		$('.beyond-fr1__sliderThumbCon').each( function() {
			numSlick++;
			$(this).addClass( 'slider-' + numSlick ).slick({
				dots: true,
				arrows: false,
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				autoplaySpeed: 5000,
				/*asNavFor: '.beyond-fr1__sliderCon.slider-' + numSlick*/
			});
		});

		/*SETS ID TO ALL SIDE TAB*/
		var numDetails = 0;
		$('.page-tabSelect a').each( function() {
			numDetails++;
			$(this).attr( 'data-id', numDetails )
		});

		/*SETS ID TO ALL SELECT TAB*/
		numDetails = 0;
		$('.page-sideNav .select option').each( function() {
			numDetails++;
			$(this).attr( 'data-id', numDetails )
			$(this).attr( 'value', numDetails )
		});

		/*SETS ID TO ALL CONTENT LIST*/
		numDetails = 0;
		$('.page-tabList').each( function() {
			numDetails++;
			$(this).attr( 'data-target', numDetails )
		});

		/*HIDES OTHER TABBING AFTER A WHILE*/
		setTimeout(function () {
			$('.page-tabList').removeClass('active');
			$('.page-tabList[data-target="1"').addClass('active');
			$('.page-tabSelect a[data-id="1"').addClass('active');
		}, 300)

		/*SETS ACTIVE CONTENT LIST ON CLICK*/
		$('.page-tabSelect a[data-id]').click(function(e) {
			e.preventDefault();
			var idTarget = $(this).data('id');
			$('.page-tabSelect a').removeClass('active');
			$(this).addClass('active');
			$('.select').val(idTarget)
			$('.page-tabList').removeClass('active');
			$('.page-tabList[data-target="' + idTarget + '"]').addClass('active');
		});

		/*SETS ACTIVE CONTENT LIST ON SELECT*/
		$(".page-sideNav .select").change( function() {      
			var idTarget = $(".select").val();
			$('.page-tabSelect a[data-id="' + idTarget + '"]').removeClass('active');
			$(this).addClass('active');
			$('.page-tabList').removeClass('active');
			$('.page-tabList[data-target="' + idTarget + '"]').addClass('active');
		});

		$(".event-fr2__slider2Con").slick({
			dots: false,
			arrows: true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			centerMode: true,
			responsive: [
				{
					breakpoint: 1025,
					settings: {
						dots: true,
					}
				},
				{
					breakpoint: 481,
					settings: {
						dots: true,
						adaptiveHeight: true,
					}
				}
			]
		});

		/*SETS ID TO ALL TABBING*/
		var numTrail = 0;
		$('.event__tabList').each( function() {
			numTrail++;
			$(this).attr( 'data-id', numTrail )
		});

		/*SETS ID TO ALL SELECT TABBING*/
		numTrail = 0;
		$('.select option').each( function() {
			numTrail++;
			$(this).attr( 'data-id', numTrail )
			$(this).attr( 'value', numTrail )
		});

		/*SETS ID TO ALL SLIDER LIST*/
		numTrail = 0;
		$('.slide__options').each( function() {
			numTrail++;
			$(this).attr( 'data-target', numTrail )
		});

		/*HIDES OTHER TABBING AFTER A WHILE*/
		setTimeout(function () {
			$('.slide__options').removeClass('active');
			$('.slide__options[data-target="1"').addClass('active');
		}, 500)

		/*SETS ACTIVE SLIDER LIST ON CLICK*/
		$('.event__tabList[data-id]').click(function(e) {
			e.preventDefault();
			var slideno = $(this).data('id');
			$('.event__tabList').removeClass('active');
			$(this).addClass('active');
			$('.select').val(slideno)
			$('.slide__options').removeClass('active');
			$('.slide__options[data-target="' + slideno + '"]').addClass('active');
		});

		/*SETS ACTIVE SLIDER LIST ON SELECT*/
		$(".select").change( function() {      
			var slideno = $(".select").val();
			$('.event__tabList[data-id="' + slideno + '"]').removeClass('active');
			$(this).addClass('active');
			$('.slide__options').removeClass('active');
			$('.slide__options[data-target="' + slideno + '"]').addClass('active');
		});


		/*$('.event-fr2__sliderCon').on('afterChange', function(event, slick, currentSlide){   
			$('.event__tabList').removeClass('active');
			$('.event__tabList[data-id=' + (currentSlide + 1) + ']').addClass('active');
			$('.select').val(currentSlide + 1)
		});*/

		/*$('.event__tabList[data-id]').click(function(e) {
			e.preventDefault();
			var slideno = $(this).data('id');
			$('.event-fr2__sliderCon').slick('slickGoTo', slideno - 1);
		});*/

		/*$(".select").change( function() {      
			var slideno = $(".select").val();
			console.log( slideno );
			$('.event-fr2__sliderCon').slick( "slickGoTo", slideno-1 );
		});*/

		/*INIT*/
		$('.wed-fr1__tabParent h5:first-child').addClass('active')
		$('.wed-fr1__tabChild p:first-child').addClass('active')

		/*SETS ID TO ALL SIDE TAB*/
		var numDetails = 0;
		$('.wed-fr1__tabParent h5').each( function() {
			numDetails++;
			$(this).attr( 'data-id', numDetails )
		});

		/*SETS ID TO ALL CONTENT LIST*/
		numDetails = 0;
		$('.wed-fr1__tabChild p').each( function() {
			numDetails++;
			$(this).attr( 'data-target', numDetails )
		});

		/*SETS ACTIVE SLIDER LIST ON CLICK*/
		$('.wed-fr1__tabParent h5[data-id]').click(function(e) {
			e.preventDefault();
			var slideno = $(this).data('id');
			$('.wed-fr1__tabParent h5').removeClass('active');
			$(this).addClass('active');
			$('.wed-fr1__tabChild p').removeClass('active');
			$('.wed-fr1__tabChild p[data-target="' + slideno + '"]').addClass('active');
		});


		var numSlick = 0;
		$('.wed-fr2__sliderCon').each( function() {
			numSlick++;
			$(this).addClass( 'slider-' + numSlick ).slick({
				dots: true,
				arrows: false,
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				autoplaySpeed: 5000,
				adaptiveHeight: true,
				asNavFor: '.wed-fr2__sliderThumbCon.slider-' + numSlick
			});
		});

		numSlick = 0;
		$('.wed-fr2__sliderThumbCon').each( function() {
			numSlick++;
			$(this).addClass( 'slider-' + numSlick ).slick({
				dots: false,
				arrows: false,
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				autoplaySpeed: 5000,
				adaptiveHeight: true,
				asNavFor: '.wed-fr2__sliderCon.slider-' + numSlick
			});
		});

		var setHeight = $('.reservation-fr2__trailCard .width--60').outerHeight();
		$('.reservation-fr2__trailCard .width--40').css('height', setHeight);


		var otherGuest = 0;
		$('.reservation-fr8__otherGuestCon').each( function() {
			otherGuest++;
			$(this).attr( 'data-target' ,'guest-' + otherGuest );
		});

		var otherGuest = 0;
		$('.reservation-fr8__selectCon ul li').each( function() {
			otherGuest++;
			$(this).attr( 'data-id' ,'guest-' + otherGuest );
		});

		$('.reservation-fr8__selectCon .selector').on('click', function(){
			$(this).parent().find('ul').slideDown(300);
		});

		$(document).on('mouseup', function(e){
			if ($(e.target).closest('.reservation-fr8__selectCon ul').length === 0) { 
				$('.reservation-fr8__selectCon').parent().find('ul').slideUp(300);
			}
		})


		$('.reservation-fr8__selectCon ul li').on('click', function(){
			var targetGuestLabel = $(this).text();
			var targetGuest = $(this).data('id');
			console.log(targetGuest);

			$('.reservation-fr8__selectCon ul').slideUp(300);
			$('.reservation-fr8__selectCon p').text(targetGuestLabel);

			$('.reservation-fr8__otherGuestCon').removeClass('active');
			$('.reservation-fr8__otherGuestCon[data-target="' + targetGuest + '"]').addClass('active');
		})

        $('#toRes-7').on('click', function(){
            $('html, body').animate({scrollTop: $('.reservation-fr7').offset().top -120 });
        })

        $('#toRes-8').on('click', function(){
            $('html, body').animate({scrollTop: $('.reservation-fr8').offset().top -120 });
        })

		/***************** ANIMATION SECTION *****************/
		var controller = new ScrollMagic.Controller();

		$('.getHere-fr1__list').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".getHere-fr1__list .width--50", 1, {opacity:0}, 0.3,)
			.staggerTo(".getHere-fr1__list .width--50", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.getHere-fr3__list').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".getHere-fr3__list .width--33", 1, {opacity:0}, 0.3,)
			.staggerTo(".getHere-fr3__list .width--33", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.travel-fr1__list').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".travel-fr1__list .l-margin-b", 1, {opacity:0}, 0.3,)
			.staggerTo(".travel-fr1__list .l-margin-b", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.event-fr4').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".event-fr4 .form-group", 1, {opacity:0}, 0.3,)
			.staggerTo(".event-fr4 .form-group", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.event-fr5').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".event-fr5 img", 1, {opacity:0}, 0.3,)
			.staggerTo(".event-fr5 img", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.wed-fr1 .page-grid').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".wed-fr1 .page__gridChild", 1, {opacity:0}, 0.3,)
			.staggerTo(".wed-fr1 .page__gridChild", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.georeserve-fr2 .page-grid').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".georeserve-fr2 .page__gridChild", 1, {opacity:0}, 0.3,)
			.staggerTo(".georeserve-fr2 .page__gridChild", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		// $('.contact-fr1').each(function() {
		// 	var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
		// 	tl.staggerFrom(".contact-fr1 .form-group", 1, {opacity:0}, 0.3,)
		// 	.staggerTo(".contact-fr1 .form-group", 1, {opacity:1}, 0.3,)

		// 	var fadeScene = new ScrollMagic.Scene({
		// 		triggerElement: this,
		// 		triggerHook: .7,
		// 		reverse:false,
		// 	})
		// 	.setTween(tl)
		// 	.addTo(controller);
		// });

		$('.projects-fr1 .page-grid').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".projects-fr1 .page__gridChild", 1, {opacity:0}, 0.3,)
			.staggerTo(".projects-fr1 .page__gridChild", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.research-fr2').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".research-fr2 .width--50", 1, {opacity:0}, 0.3,)
			.staggerTo(".research-fr2 .width--50", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.info-fr1 .page-grid').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".info-fr1 .page__gridChild", 1, {opacity:0}, 0.3,)
			.staggerTo(".info-fr1 .page__gridChild", 1, {opacity:1}, 0.3,)

			var fadeScene = new ScrollMagic.Scene({
				triggerElement: this,
				triggerHook: .7,
				reverse:false,
			})
			.setTween(tl)
			.addTo(controller);
		});

		$('.reservation-fr2').each(function() {
			var tl = new TimelineMax({repeat:0, repeatDelay:0.5,});
			tl.staggerFrom(".reservation-fr2__trailCard", 1, {opacity:0}, 0.3,)
			.staggerTo(".reservation-fr2__trailCard", 1, {opacity:1}, 0.3,)

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