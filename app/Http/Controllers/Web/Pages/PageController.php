<?php

namespace App\Http\Controllers\Web\Pages;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;

use App\Models\Eventpdfs\Eventpdf;
use App\Models\Weddingpdfs\Weddingpdf;
use App\Models\Georeservepolicies\Georeservepolicy;
use App\Models\EventCarousels\EventCarousel;
use App\Models\EventInformations\EventInformation;
use App\Models\BeyondMasungi\BeyondMasungi;
use App\Models\EventTypes\EventType;
use App\Models\Events\Event;
use App\Models\PreviousGuests\PreviousGuest;
use App\Models\WeddingBoards\WeddingBoard;
use App\Models\WeddingVenues\WeddingVenue;
use App\Models\Venues\Venue;
use App\Models\InformationKits\InformationKit;
use App\Models\Researches\Research;
use App\Models\Collaborators\Collaborator;
use App\Models\DestinationCarousel\DestinationCarousel;
use App\Models\Carousels\HomeBanner;
use App\Models\Features\Feature;
use App\Models\News\News;
use App\Models\Awards\Award;
use App\Models\Galleries\Gallery;
use App\Models\ExperienceCarousels\ExperienceCarousel;
use App\Models\OldNewCarousels\OldNewCarousel;
use App\Models\Declarations\Declaration;
use App\Models\TimeSlots\TimeSlot;
use App\Models\Bankdetails\Bankdetail;

use App\Models\Pages\Page;
use App\Models\Trails\Trail;
use App\Models\AddOns\AddOn;
use Webpatser\Countries\Countries;

use Carbon\Carbon;

class PageController extends Controller
{
	/* Show Home */
	public function showHome() {
    	$data = $this->getPageData('home');
        $oldnewmasungis = OldNewCarousel::all();
        $experiences = Trail::all();
        $galleries = Gallery::all();
        $awards = Award::all();
        $news = News::latest();
		$newsitems = News::orderby('published_date', 'desc')
							->take(3)
							->get()
							->map(function($query) {
								$query->showUrl = $query->renderShowUrl('web');
								return $query;
							});

		$features = Feature::all();
		$homebanners = HomeBanner::all();  
		$today = Carbon::now()->format('Y-m-d');
		$trails = Trail::whereDate('date_to_show', $today)
						->whereDate('expiration_date', '>', $today)
						->orWhereNull('date_to_show')
						->orWhere('is_special_event', false)->get();
		$trail_items = [];
		foreach ($trails as $trail) {
					array_push($trail_items, [
						'id' => $trail->id,
						'duration' => $trail->estimated_duration,
						'recommended' => $trail->recommended_for,
						'minimum_participant' => $trail->minimum_participant,
						'name' => $trail->name,
						'short_description' => str_limit($trail->description, 50),
						'full_description' => $trail->description,
						'weekend_fee' => $trail->weekend_fee,
						'weekday_fee' => $trail->weekday_fee,
						'paypal_charges' => $trail->paypal_charges,
						'fee_per_guest' => $trail->fee_per_guest,
						'terms_and_condition' => $trail->terms_and_condition,
						'path' => $trail->renderImagePath(),
						'blocked_dates' => $trail->getBlockDate(),
						'age_group' => $trail->age_group,
						'cut_off' => $trail->cut_off
						// 'dayTrailSlots' => $trail->getTimeSlots('day'),
						// 'nightTrailSlots' => $trail->getTimeSlots('night'),
						// 'dayNightTrailSlots' => $trail->getTimeSlots('dayNight')
					]);
				}

        return view('web.pages.home', array_merge($data, [
	        'oldnewmasungis' => OldNewCarousel::formatList($oldnewmasungis),
	        'experiences' => Trail::formatList($experiences),      
	        'galleries' => Gallery::formatList($galleries),        
	        'awards' => Award::formatList($awards),
	        'news' => News::formatList($news),
	        'newsitems' => News::formatList($newsitems),
	        'features' => Feature::formatlist($features),
	        'homebanners' => HomeBanner::formatlist($homebanners),
	        'trails' => $trail_items
        ]));
	}

	// /* Show About */
	// public function showAbout() {
	// 	$data = $this->getPageData('about');
 //        return view('web.pages.about', $data);
	// }

	/* Show Contact Us */
	public function showContactUs() {
		$data = $this->getPageData('contact_us');
        return view('web.pages.contactus', $data);
	}

	/* Show Terms and Conditions */
	public function showTerms() {
		$data = $this->getPageData('terms_and_conditions');
        return view('web.pages.terms', $data);
	}

	/* Show Privacy Policy */
	public function showPrivacy() {
		$data = $this->getPageData('privacy_policy');
        return view('web.pages.privacy', $data);
	}

	/* Show Sample Page */
	public function showSamplePage() {
        return view('web.pages.samples.index', [

        ]);
	}

	/* DESTINATIONS */

	/* Show About Us*/

	public function showAboutUs(){
		$data = $this->getPageData('about_us');
		$destinations = DestinationCarousel::where('name', DestinationCarousel::TYPE_ABOUTMASUNGI)->get();

	        return view('web.pages.about', array_merge($data,[

		        'destinations' => DestinationCarousel::formatList($destinations),



	        ]));
	}

	public function showGettingHere(){
		$data = $this->getPageData('getting_here');
        return view('web.pages.destination.gettingHere',$data);
	}

	public function showTheArea(){
		$data = $this->getPageData('the_area');
		$destinations = DestinationCarousel::where('name', DestinationCarousel::TYPE_THEAREA)->get();


	        return view('web.pages.destination.theArea',array_merge($data,[
		        'destinations' => DestinationCarousel::formatList($destinations),


	        ]));
	}

	public function showTravelInformation(){
		$data = $this->getPageData('travel_information');
        return view('web.pages.destination.travelInformation',$data);
	}	

	/* GEORESERVE POLICIES */

	public function showGeoreserve(){
		$data = $this->getPageData('georeserve_policies');
		$policies = Georeservepolicy::all();

	        return view('web.pages.georeserve', array_merge($data,[
		        'policies' => Georeservepolicy::formatlist($policies)

	        ]));
	}

	/* EVENTS */

	public function showCompanyEvents($id, $name) {
    $data = $this->getPageData('company_event');				
	$event = Event::find($id);
	$eventtype = EventType::find($id);

	$eventtypes = $event->eventtype;	 	
	$previousguests = $event->previousguest;
	$eventpdfs = Eventpdf::all();	
	$eventcarousels = EventCarousel::all();
	$teambuildings =  EventInformation::where('name', EventInformation::TYPE_TEAMBUILDING)->get();


		return view('web.pages.events.event', array_merge($data,[
			'previousguests' => PreviousGuest::formatlist($previousguests),
			'eventcarousels' => EventCarousel::formatlist($eventcarousels),	
			'eventpdfs' => Eventpdf::formatlist($eventpdfs),			
			'event' => $event,
			'eventtype' => $eventtype,
			'eventtypes' => $eventtypes,
			'teambuildings' => EventInformation::formatlist($teambuildings),

		]));

	}

	public function showteamBuilding() {
	$teambuildings =  EventInformation::where('name', EventInformation::TYPE_TEAMBUILDING)->get();

	return view('web.pages.events.eventView', array_merge([
	'teambuildings' => EventInformation::formatlist($teambuildings),

	]));
	
	}

	public function showgroveProject() {
	$nurtures =  EventInformation::where('name', EventInformation::TYPE_NUTUREAGROVEPROJECT)->get();

	return view('web.pages.events.eventViewTwo', array_merge([
	'nurtures' => EventInformation::formatlist($nurtures),

	]));
	
	}


	public function showSchoolVisits() {
    $data = $this->getPageData('school_visit');						
	$previousguests = PreviousGuest::where('type', PreviousGuest::TYPE_SCHOOL)->get();
	$discoveries =  EventType::where('name', EventType::TYPE_DISCOVERYTRAIL)->get();
	$legacies =  EventType::where('name', EventType::TYPE_LEGACYTRAIL)->get();
	$families =  EventType::where('name', EventType::TYPE_FAMILYTRAIL)->get();
	$youngs =  EventType::where('name', EventType::TYPE_YOUNGEXPLORERSTRAIL)->get();

	$discoveriescarousel =  EventCarousel::where('name', EventCarousel::TYPE_DISCOVERYTRAIL)->get();
	$legaciescarousel =  EventCarousel::where('name', EventCarousel::TYPE_LEGACYTRAIL)->get();
	$familiescarousel =  EventCarousel::where('name', EventCarousel::TYPE_FAMILYTRAIL)->get();
	$youngscarousel =  EventCarousel::where('name', EventCarousel::TYPE_YOUNGEXPLORERSTRAIL)->get();


	return view('web.pages.events.schoolVisits', array_merge($data,[
	'previousguests' => PreviousGuest::formatlist($previousguests),
	'discoveries' => EventType::formatlist($discoveries),
	'legacies' => EventType::formatlist($legacies),
	'families' => EventType::formatlist($families),
	'youngs' => EventType::formatlist($youngs),

	'discoveriescarousel' => EventCarousel::formatlist($discoveriescarousel),
	'legaciescarousel' => EventCarousel::formatlist($legaciescarousel),
	'familiescarousel' => EventCarousel::formatlist($familiescarousel),
	'youngscarousel' => EventCarousel::formatlist($youngscarousel),


	]));

	}


	public function showWeddings(){
    $data = $this->getPageData('weddings');		
	$venues =  Venue::with('weddingVenues')->get();
	$weddingboards = WeddingBoard::all();
	$weddingpdfs = Weddingpdf::all();


	return view('web.pages.events.weddings', array_merge($data,[
    'venues' => Venue::formatlist($venues),
    'weddingboards' => WeddingBoard::formatlist($weddingboards),
    'weddingpdfs' => Weddingpdf::formatlist($weddingpdfs),

	]));

	}

	/* EXPERIENCE */

	public function showbeyondMasungi(){
    $data = $this->getPageData('beyond_masungi');								
	$natures = BeyondMasungi::where('title', BeyondMasungi::TYPE_NATURE)->get();
	$cultures = BeyondMasungi::where('title', BeyondMasungi::TYPE_CULTURE)->get();
	$arts = BeyondMasungi::where('title', BeyondMasungi::TYPE_ARTS)->get();
	$seas = BeyondMasungi::where('title', BeyondMasungi::TYPE_SEA)->get();


    return view('web.pages.experience.beyondMasungi', array_merge($data,[
     'natures' => BeyondMasungi::formatlist($natures),
     'cultures' => BeyondMasungi::formatlist($cultures),
     'arts' => BeyondMasungi::formatlist($arts),
     'seas' => BeyondMasungi::formatlist($seas),

    ]));

	}

	/* MORE */	

	public function showGallery(){
	$landscapes = Gallery::where('category', Gallery::TYPE_LANDSCAPE)->get();
	$peoples = Gallery::where('category', Gallery::TYPE_PEOPLE)->get();
	$wildlife = Gallery::where('category', Gallery::TYPE_WILDLIFE)->get();
	$moments = Gallery::where('category', Gallery::TYPE_MOMENTS)->get();

    return view('web.pages.gallery', array_merge([
     'landscapes' => Gallery::formatlist($landscapes),
     'peoples' => Gallery::formatlist($peoples),
     'wildlife' => Gallery::formatlist($wildlife),
     'moments' => Gallery::formatlist($moments),


    ]));

	}


	public function showCollaborator(){
	$collaborators = Collaborator::all();   


    return view('web.pages.projects', array_merge([
     'collaborators' => Collaborator::formatlist($collaborators),


    ]));

	}

	public function showResearch(){
	$data = $this->getPageData('research');
	$researches = Research::all();   

      
     return view('web.pages.research',array_merge($data,[
     'researches' => Research::formatlist($researches),


    ]));
	}

	public function showInformationKits(){
		$data = $this->getPageData('information_kits');
		$infokits = InformationKit::all();   


        return view('web.pages.informationKits',array_merge($data,[
   	    'infokits' => InformationKit::formatlist($infokits),


    ]));
	}	

	public function showNews(){
        return view('web.pages.news.index');
	}

	public function fetchNews(){
		$paginatedNews = News::orderBy('published_date', 'desc')->paginate(10);

		$mappedNews = $paginatedNews
            ->getCollection()
            ->map(function($item) {
                return [
					'id' => $item->id,
					'news_id' => $item->id, 
					'title' => $item->title,
					'description' => $item->description,
					'link' => $item->link,
					'link_label' => $item->link_label,     
					'showUrl' => $item->renderShowUrl('web'),     
					'image_path' => $item->renderImagePath('image_path'),
					'published_date' => $item->renderDateNews('published_date'),
				];
        });

		$news = new \Illuminate\Pagination\LengthAwarePaginator(
            $mappedNews,
            $paginatedNews->total(),
            $paginatedNews->perPage(),
            $paginatedNews->currentPage(), [
                'path' => \Request::url(),
                'query' => [
                    'page' => $paginatedNews->currentPage()
                ]
            ]
        );

		return $news;
	}

	public function showNewsView($id){
		$item = News::withTrashed()->findOrFail($id);
		$item->image_path = $item->renderImagePath('image_path');

        return view('web.pages.news.view', [
            'item' => $item,
        ]);
	}


	public function reservation() {
		$trail_items = [];
		$bank_details = Bankdetail::all();
		$today = Carbon::now()->format('Y-m-d');
		$trails = Trail::whereDate('date_to_show', $today)
						->whereDate('expiration_date', '>', $today)
						->orWhereNull('date_to_show')
						->orWhere('is_special_event', false)->get();
		$snacks = AddOn::all();
		$countries = Countries::orderby('name', 'asc')->get();
		$declarations = Declaration::all();

		foreach ($trails as $trail) {
			array_push($trail_items, [
				'id' => $trail->id,
				'duration' => $trail->estimated_duration,
				'recommended' => $trail->recommended_for,
				'minimum_participant' => $trail->minimum_participant,
				'maximum_guest' => $trail->maximum_guest,
				'name' => $trail->name,
				'short_description' => str_limit($trail->overview, 50),
				'full_description' => $trail->overview,
				'weekend_fee' => $trail->weekend_fee,
				'weekday_fee' => $trail->weekday_fee,
				'paypal_charges' => $trail->paypal_charges,
				'fee_per_guest' => $trail->fee_per_guest,
				'terms_and_condition' => $trail->terms_and_condition,
				'path' => $trail->renderImagePath(),
				'blocked_dates' => $trail->getBlockDate(),
				'age_group' => $trail->age_group,
				'cut_off' => $trail->cut_off,
				'snacks' => $trail->snacks->toArray(),
				'has_snack' => $trail->has_snack,
				// 'dayTrailSlots' => $trail->getTimeSlots('day'),
				// 'nightTrailSlots' => $trail->getTimeSlots('night'),
				// 'dayNightTrailSlots' => $trail->getTimeSlots('dayNight')
			]);
		}
		
		return view('web.pages.reservation', [
			'trails' => json_encode($trail_items),
			'snacks' => $snacks,
			'countries' => $countries,
			'declarations' => $declarations,
			'bank_details' => $bank_details
		]); 
	}

	public function showPayment($name, $reference_code, $total) {
		return view('web.pages.payment', [
			'reference_code' => $reference_code, 
			'total' => $total, 
		]);
	}

	public function showTrailDetails($id, $name) {
		$trail = Trail::find($id);
		$trail['fullpath'] = $trail->renderImagePath();

		$trail['blocked_dates'] = $trail->getBlockDate();
		// $trail['dayTrailSlots'] = $trail->getTimeSlots('day');
		// $trail['nightTrailSlots'] = $trail->getTimeSlots('night');
		// $trail['dayNightTrailSlots'] = $trail->getTimeSlots('dayNight');

		return view('web.pages.experience.generalTrail', [
			'trail' => $trail
		]); 
	}
	
	public function paymentSuccess(Request $request) {
		return redirect()->route('web.payment.success.page');
	}

	public function paymentSuccessPage() {
		return view('web.pages.payment-success'); 
	}

	/* Get Page Data */
	protected function getPageData($slug) {
		$item = Page::where('slug', $slug)->firstOrFail();
		return $item->getData();
	}

}
