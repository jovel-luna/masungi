<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('sandbox', 'SandboxController@index')->name('sandbox.index');

Route::post('ckeditor/upload', 'CkeditorController@upload');

Route::namespace('Web')->name('web.')->group(function() {

	Route::namespace('Auth')->group(function() {

		/* Guest Routes */
		Route::middleware('guest:web')->group(function() {

	        Route::get('login', 'LoginController@showLoginForm')->name('login');
	        Route::post('login', 'LoginController@login');

	        Route::get('reset-password/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
	        Route::post('reset-password/change', 'ResetPasswordController@reset')->name('password.change');

	        Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
	        Route::post('forgot-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

	        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
	        Route::post('register', 'RegisterController@register');

	        /* Socialite Login */
	        Route::get('socialite/{provider}/login', 'SocialiteLoginController@login')->name('socialite.login');
			Route::get('socialite/{provider}/callback', 'SocialiteLoginController@callback')->name('socialite.callback');

			/* Facebook Login */
			Route::get('socialite/facebook/login', 'SocialiteLoginController@login')->name('facebook.login');
			Route::get('socialite/facebook/callback', 'SocialiteLoginController@callback')->name('facebook.callback');

		});

        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');

	});

	/* Page Routes */
	Route::namespace('Pages')->group(function() {

		Route::get('', 'PageController@showHome')->name('home');
		Route::get('/destination/about-us', 'PageController@showAboutUs')->name('about');
		Route::get('/destination/getting-here', 'PageController@showGettingHere')->name('gettingHere');
		Route::get('/destination/the-area', 'PageController@showTheArea')->name('theArea');
		Route::get('/destination/travel-information', 'PageController@showTravelInformation')->name('travelInformation');
		Route::get('/georeserve-policies', 'PageController@showGeoreserve')->name('georeserve');
		Route::get('/research', 'PageController@showResearch')->name('research');		
		Route::get('/information-kits', 'PageController@showInformationKits')->name('informationKits');	
		Route::get('/contact-us', 'PageController@showContactUs')->name('contactus');
		Route::get('/news', 'PageController@showNews')->name('news');
		Route::post('/fetch-news', 'PageController@fetchNews')->name('news-fetch');
		Route::get('/news/view/{id}', 'PageController@showNewsView')->name('news-view');

		Route::get('COVID-19-Safety', 'PageController@showTerms')->name('terms');
		Route::get('privacy-policy', 'PageController@showPrivacy')->name('privacy');
		Route::get('/projects-collaborators', 'PageController@showCollaborator')->name('projects');
		Route::get('/gallery', 'PageController@showGallery')->name('gallery');	
	    Route::get('/events/weddings', 'PageController@showWeddings')->name('weddings');
		Route::get('/events/school-visits', 'PageController@showSchoolVisits')->name('schoolVisits');	
		Route::get('/experience/beyond-masungi', 'PageController@showbeyondMasungi')->name('beyondMasungi');
		Route::get('/events/company-events', 'PageController@showCompanyEvents')->name('companyEvents');	
		Route::get('/events/company-events/team-building', 'PageController@showteamBuilding')->name('teamBuilding');
		Route::get('/events/company-events/nurture-a-groveproject', 'PageController@showgroveProject')->name('groveProject');

	});

	Route::namespace('Pages')->group(function() {
		Route::get('payment/{name}/{reference_code}/{grand_total}', 'PageController@showPayment')->name('payment');
		Route::get('/experience/trails/{id}/{name}', 'PageController@showTrailDetails')->name('trails');
		Route::get('/events/events/{id}/{name}', 'PageController@showCompanyEvents')->name('events');


		/*************/
		/*RESERVATION*/
		/*************/
		Route::get('/visitrequest', 'PageController@reservation')->name('reservation');
		Route::post('/payment/success', 'PageController@paymentSuccess')->name('payment.success');
		Route::get('/transaction/success', 'PageController@paymentSuccessPage')->name('payment.success.page');
		
	});

	Route::namespace('Bookings')->group(function() {
		Route::post('/date/checker', 'TimeSlotController@getTimeslots')->name('check.date');
		Route::post('/fetch/fully-booked-dates', 'TimeSlotController@getFullyBookedDates')->name('fetch.fully-booked-dates');
		Route::post('book/reservation', 'BookingController@insertBooking')->name('insert.booking');
		Route::post('/fetch/available-monday-slots', 'BookingController@getAvailableMondaySlots')->name('fetch.available-monday-slots');
		Route::post('/date/check-if-available', 'BookingController@checkIfAvailable')->name('date.check-if-available');
	});

	Route::namespace('Inquiries')->group(function() {
		Route::post('inquiry/contact-us', 'InquiryController@contactUsStore')->name('inquiry.contact-us');
		Route::post('inquiry/company-inquiry', 'InquiryController@companyInquiry')->name('inquiry.company-inquiry');
		Route::post('inquiry/school-inquiry', 'InquiryController@schoolInquiry')->name('inquiry.school-inquiry');
		Route::post('inquiry/wedding-inquiry', 'InquiryController@weddingInquiry')->name('inquiry.wedding-inquiry');
	});

	Route::namespace('Newsletters')->group(function() {
		Route::post('home/newsletters', 'NewsletterController@newsletterStore')->name('home.newsletters');

	});		
});



/************/
/*STLYESHEET*/
/************/
Route::get('/stylesheet', function () { 
	return view('web.pages.stylesheet'); 
})->name('web.stylesheet');


/************/
/*EXPERIENCE*/
/************/

// Route::get('/experience/family-trail', function () { 
// 	return view('web.pages.experience.generalTrail'); 
// })->name('web.familyTrail');

// Route::get('/experience/legacy-trail', function () { 
// 	return view('web.pages.experience.generalTrail'); 
// })->name('web.legacyTrail');

// Route::get('/experience/dining', function () { 
// 	return view('web.pages.experience.beyondMasungi'); 
// })->name('web.dining');


/*******/
/*EVENT*/
/*******/

// Route::get('/events/bird-watching', function () { 
// 	return view('web.pages.events.event'); 
// })->name('web.birdWatching');

// Route::get('/contact-us', function () { 
// 	return view('web.pages.contactus'); 
// })->name('web.contactus');

// Route::get('/news', function () { 
// 	return view('web.pages.news.index'); 
// })->name('web.news');

// Route::get('/news/view', function () { 
// 	return view('web.pages.news.view'); 
// })->name('web.newsArticle');

