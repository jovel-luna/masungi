<?php

namespace App\Extenders\Controllers\ActivityLogs;

use Illuminate\Http\Request;
use App\Extenders\Controllers\FetchController as Controller;

use App\Models\ActivityLogs\ActivityLog;

use App\Models\Pages\Page;
use App\Models\Pages\MetaTag;

class ActivityLogFetchController extends Controller
{
    /**
     * Set object class of fetched data
     * 
     * @return void
     */
    public function setObjectClass() 
    {
        $this->class = new ActivityLog;
    }

    /**
     * Custom filtering of query
     * 
     * @param Illuminate\Support\Facades\DB $query
     * @return Illuminate\Support\Facades\DB $query
     */
    public function filterQuery($query) 
    {
        $query = $this->additionalQuery($query);






        $query = $this->filterSubject($query, 'addons', 'App\Models\AddOns\Addon');
        $query = $this->filterSubject($query, 'articles', 'App\Models\Articles\Article');
        $query = $this->filterSubject($query, 'awards', 'App\Models\Awards\Award');
        $query = $this->filterSubject($query, 'beyondmasungi', 'App\Models\BeyondMasungi\BeyondMasungi');
        $query = $this->filterSubject($query, 'blockdateandtime', 'App\Models\BlockedDateAndTime\BlockedDateAndTime');            
        $query = $this->filterSubject($query, 'capacities', 'App\Models\Capacities\Capacity');  
        $query = $this->filterSubject($query, 'carousel', 'App\Models\Carousels\Carousel');

        $query = $this->filterSubject($query, 'collaborators', 'App\Models\Collaborators\Collaborator');                
        $query = $this->filterSubject($query, 'companyinquiries', 'App\Models\CompanyInquiries\CompanyInquiry');                
        $query = $this->filterSubject($query, 'contactus', 'App\Models\ContactUs\ContactUs');                
        $query = $this->filterSubject($query, 'declarations', 'App\Models\Declarations\Declaration');                
        $query = $this->filterSubject($query, 'destinationcarousel', 'App\Models\DestinationCarousel\DestinationCarousel');
        $query = $this->filterSubject($query, 'eventcarousels', 'App\Models\EventCarousels\EventCarousel');
        $query = $this->filterSubject($query, 'eventinformations', 'App\Models\EventInformations\EventInformation');    
        $query = $this->filterSubject($query, 'eventpdfs', 'App\Models\Eventpdfs\Eventpdf');               
        $query = $this->filterSubject($query, 'events', 'App\Models\Events\Event');               
        $query = $this->filterSubject($query, 'eventtypes', 'App\Models\EventTypes\EventTypes');             
        $query = $this->filterSubject($query, 'experiencecarousels', 'App\Models\ExperienceCarousels\ExperienceCarousel');
        $query = $this->filterSubject($query, 'experience-information', 'App\Models\ExperienceInformations\ExperienceInformation');
        $query = $this->filterSubject($query, 'experience', 'App\Models\Experiences\Experience');
        $query = $this->filterSubject($query, 'faqs', 'App\Models\Faqs\Faq');     
        $query = $this->filterSubject($query, 'features', 'App\Models\Features\Feature');
        $query = $this->filterSubject($query, 'galleries', 'App\Models\Galleries\Gallery');             
        $query = $this->filterSubject($query, 'georeservepolicies', 'App\Models\Georeservepolicies\Georeservepolicy');        
        $query = $this->filterSubject($query, 'informationkits', 'App\Models\InformationKits\InformationKit');
        $query = $this->filterSubject($query, 'news', 'App\Models\News\News');
        $query = $this->filterSubject($query, 'newsletters', 'App\Models\Newsletters\Newsletter');
        $query = $this->filterSubject($query, 'notifications', 'App\Models\Notifications\Notification');
        $query = $this->filterSubject($query, 'oldnewcarousels', 'App\Models\OldNewCarousels\OldNewCarousel');
        $query = $this->filterSubject($query, 'pdflinks', 'App\Models\Pdflinks\Pdflink');                  
        $query = $this->filterSubject($query, 'previousguests', 'App\Models\PreviousGuests\PreviousGuest');
        $query = $this->filterSubject($query, 'researches', 'App\Models\Researches\Research');
        $query = $this->filterSubject($query, 'schoolinquiries', 'App\Models\SchoolInquiries\SchoolInquiry');
        $query = $this->filterSubject($query, 'time-slots', 'App\Models\TimeSlots\TimeSlot');
        $query = $this->filterSubject($query, 'trails', 'App\Models\Trails\Trail');
        $query = $this->filterSubject($query, 'trailstops', 'App\Models\TrailStops\TrailStop');
        $query = $this->filterSubject($query, 'weddingboards', 'App\Models\WeddingBoards\WeddingBoard');
        $query = $this->filterSubject($query, 'weddinginquiries', 'App\Models\WeddingInquiries\WeddingInquiry');
        $query = $this->filterSubject($query, 'weddingpdfs', 'App\Models\Weddingpdfs\Weddingpdf');
        $query = $this->filterSubject($query, 'weddingvenues', 'App\Models\WeddingVenues\WeddingVenue');
        $query = $this->filterSubject($query, 'venues', 'App\Models\Venues\Venue');

        

        $query = $this->filterSubject($query, 'sampleitems', 'App\Models\Samples\SampleItem');
        $query = $this->filterSubject($query, 'roles', 'App\Models\Roles\Role');
        $query = $this->filterSubject($query, 'pageitems', 'App\Models\Pages\PageItem');
        $query = $this->filterSubject($query, 'user', 'App\Models\Users\User');
        $query = $this->filterSubject($query, 'admin', 'App\Models\Users\Admin');
        $query = $this->filterSubject($query, 'declarations', 'App\Models\Declarations\Declaration');
        $query = $this->filterSubject($query, 'subject_type', $this->request->input('subject_type'));

        /* Get page and related page item logs */
        if ($this->request->filled('pagecontents')) {
            $subjects = ['App\Models\Pages\PageItem', 'App\Models\Pages\Page', ''];

            $pageIds = $query->where('subject_type', 'App\Models\Pages\Page')->pluck('id')->toArray();
            $pageItems = $query->where('subject_type', 'App\Models\Pages\PageItem');

            if ($this->request->filled('id')) {
                $page = Page::withTrashed()->findOrFail($this->request->input('id'));
                $pageItemIds = $page->page_items()->pluck('id')->toArray();
                $pageItems = $pageItems->whereIn('subject_id', $pageItemIds);
            }

            $pageItemIds = $pageItems->pluck('id')->toArray();

            $query = $query->whereIn('id', array_merge($pageIds, $pageItemIds));
        }

        return $query;
    }

    /**
     * Filter Subject
     * @param  QueryBuilder $query   
     * @param  string $param  
     * @param  string $subject 
     * @return Query Builder          
     */
    protected function filterSubject($query, $param, $subject, $id = false) 
    {
        if ($this->request->filled($param)) {
            $filters = [
                'subject_type' => $subject,
            ];

            if ($id) {
                $filters = array_merge($filters, [
                    'subject_id' => $id,
                ]);
            } else {
                if ($this->request->filled('id')) {
                    $filters = array_merge($filters, [
                        'subject_id' => $this->request->input('id'),
                    ]);
                }
            }

            $query = $query->where($filters);
        }

        return $query;
    }

    /**
     * Additional Query for when being extended
     * @param  QueryBuilder $query
     * @return QueryBuilder
     */
    public function additionalQuery($query) 
    {
        return $query;
    }

    /**
     * Custom formatting of data
     * 
     * @param Illuminate\Support\Collection $items
     * @return array $result
     */
    public function formatData($items) 
    {
        $result = [];

        foreach($items as $item) {
            $data = $this->formatItem($item);

            array_push($result, array_merge($data, [
                'id' => $item->id,
                'name' => $item->renderName(),
                'caused_by' => $item->renderCauserName(),
                'show_causer' => $item->renderCauserShowUrl(),
                'subject_type' => $item->renderSubjectType(),
                'subject_name' => $item->renderSubjectName(),
                'created_at' => $item->renderDate(),
            ]));
        }

        return $result;
    }

    /**
     * Additional property when extended
     * 
     * @param  App\Contracts\AvailablePosition
     * @return array
     */
    protected function formatItem($item) 
    {
        return [
            'showUrl' => $item->renderShowUrl(),
        ];
    }
}
