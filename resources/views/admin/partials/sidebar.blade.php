<aside class="main-sidebar sidebar-dark-secondary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link bg-secondary">
        @include('partials.brand')
    </a>

    <div class="sidebar">
        @if (auth()->check())
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ $self->renderAvatar() }}" class="img-circle elevation-2" style="width: 35px; height: 35px;">
                </div>
                <div class="info">
                    <a href="{{ route('admin.profiles.show') }}" class="d-block">
                        {{ $self->renderName() }}
                    </a>
                </div>
            </div>
        @endif

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if ($self->hasAnyPermission(['admin.time-slots.crud']))                                
                <li class="nav-item">
                    <a href="{{ route('admin.time-slots.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.time-slots.index','admin.time-slots.create','admin.time-slots.show',
                    ]) }}">
                        <i class="nav-icon fa fa-clock"></i>
                        <p>
                            Time slots
                        </p>
                    </a>
                </li>
                @endif

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if ($self->hasAnyPermission(['admin.bankdetails.crud']))                
                <li class="nav-item">
                    <a href="{{ route('admin.bankdetails.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.bankdetails.index','admin.bankdetails.create','admin.bankdetails.show',
                    ]) }}">
                        <i class="nav-icon fa fa-file-alt"></i>
                        <p>
                            Bankdetails
                        </p>
                    </a>
                </li>
                @endif
                


                @if($self->hasAnyPermission(['admin.experiences.crud', 'admin.trails.crud', 'admin.blocked-dates.crud', 'admin.capacities.crud', 'admin.trailstops.crud', 'admin.experience-information.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.experiences.index','admin.experiences.create','admin.experiences.show','admin.trails.index','admin.trails.create','admin.trails.show','admin.blocked-dates.index','admin.blocked-dates.create','admin.blocked-dates.show','admin.capacities.index','admin.capacities.create','admin.capacities.show','admin.trailstops.index','admin.trailstops.create','admin.trailstops.show','admin.experience-information.index','admin.experience-information.create','admin.experience-information.show',

                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link {{ $checker->route->areOnRoutes([
                             'admin.experiences.index','admin.experiences.create','admin.experiences.show',
                        ]) }}">
                            <i class="nav-icon far fa-map"></i>
                            <p>
                                Experiences
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                    <ul class="nav nav-treeview">                       
                    @if ($self->hasAnyPermission(['admin.experiences.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.experiences.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.experiences.index','admin.experiences.create','admin.experiences.show',
                           ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Experiences
                            </p>
                        </a>
                    </li>
                    @endif
                    
                    @if ($self->hasAnyPermission(['admin.trails.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.trails.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.trails.index','admin.trails.create','admin.trails.show', 
                           ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Trails
                            </p>
                        </a>
                    </li>
                    @endif

                    @if ($self->hasAnyPermission(['admin.blocked-dates.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.blocked-dates.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.blocked-dates.index','admin.blocked-dates.create','admin.blocked-dates.show'
                           ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Block Date And Time
                            </p>
                        </a>
                    </li>
                    @endif
                    {{-- @if ($self->hasAnyPermission(['admin.capacities.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.capacities.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.capacities.index','admin.capacities.show','admin.capacities.create',
                        ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Capacities
                            </p>
                        </a>
                    </li>         
                    @endif --}}
                    @if ($self->hasAnyPermission(['admin.trailstops.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.trailstops.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.trailstops.index','admin.trailstops.show','admin.trailstops.create',
                        ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Features
                            </p>
                        </a>
                    </li>
                    @endif
                    @if ($self->hasAnyPermission(['admin.experience-information.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.experience-information.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.experience-information.index','admin.experience-information.create','admin.experience-information.show',
                           ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Experience Information
                            </p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

        @if ($self->hasAnyPermission(['admin.contactus.crud','admin.companyinquiries.crud','admin.schoolinquiries.crud','admin.weddinginquiries.crud','admin.newsletters.crud']))
           <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.contactus.show','admin.contactus.create','admin.contactus.index','admin.companyinquiries.index','admin.companyinquiries.create','admin.schoolinquiries.index','admin.schoolinquiries.show','admin.schoolinquiries.create','admin.weddinginquiries.index','admin.weddinginquiries.show','admin.weddinginquiries.create','admin.newsletters.index','admin.newsletters.create','admin.newsletters.show',

                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.contactus.show','admin.contactus.create','admin.contactus.index','admin.companyinquiries.index','admin.companyinquiries.create','admin.schoolinquiries.index','admin.schoolinquiries.show','admin.schoolinquiries.create','admin.weddinginquiries.index','admin.weddinginquiries.show','admin.weddinginquiries.create','admin.newsletters.index','admin.newsletters.create','admin.newsletters.show',
                        ]) }}">
                            <i class="nav-icon fa fa-headphones"></i>
                            <p>
                                Inquiries
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                <ul class="nav nav-treeview">    
                    @if ($self->hasAnyPermission(['admin.contactus.crud']))                             
                    <li class="nav-item">
                        <a href="{{ route('admin.contactus.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.contactus.index','admin.contactus.show','admin.contactus.create',                      
                        ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Contact Us
                            </p>
                        </a>
                    </li>
                    @endif
                    @if ($self->hasAnyPermission(['admin.companyinquiries.crud']))                             
                    <li class="nav-item">
                        <a href="{{ route('admin.companyinquiries.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.companyinquiries.index','admin.companyinquiries.show','admin.companyinquiries.create',
                        ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                 Company Inquiry
                            </p>
                        </a>
                    </li>
                    @endif
                    @if ($self->hasAnyPermission(['admin.schoolinquiries.crud']))                                                 
                    <li class="nav-item">
                        <a href="{{ route('admin.schoolinquiries.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.schoolinquiries.index','admin.schoolinquiries.show','admin.schoolinquiries.create',
                        ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                 School Inquiry
                            </p>
                        </a>
                    </li>
                    @endif
                    @if ($self->hasAnyPermission(['admin.weddinginquiries.crud']))                                                 
                    <li class="nav-item">
                        <a href="{{ route('admin.weddinginquiries.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.weddinginquiries.index','admin.weddinginquiries.show','admin.weddinginquiries.create',
                        ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                 Wedding Inquiry
                            </p>
                        </a>
                    </li>
                    @endif
                    @if ($self->hasAnyPermission(['admin.newsletters.crud']))        
                    <li class="nav-item">
                        <a href="{{ route('admin.newsletters.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.newsletters.index','admin.newsletters.create','admin.newsletters.show',
                        ]) }}">
                            <i class="nav-icon far fa-circle"></i>
                            <p>
                                Newsletters
                            </p>
                        </a>
                    </li>         
                    @endif                               
                 </ul>
              </li>
        @endif
        
        @if ($self->hasAnyPermission(['admin.events.crud','admin.eventtypes.crud','admin.eventinformations.crud','admin.eventcarousels.crud','admin.eventpdfs.crud']))        
         <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                         'admin.events.index','admin.events.show','admin.events.create',                         
                         'admin.eventtypes.index','admin.eventtypes.show','admin.eventtypes.create',
                         'admin.eventinformations.index','admin.eventinformations.show','admin.eventinformations.create',
                         'admin.eventcarousels.index','admin.eventcarousels.show','admin.eventcarousels.create',
                         'admin.previousguests.index','admin.previousguests.show','admin.previousguests.create',
                         'admin.eventpdfs.index','admin.eventpdfs.create','admin.eventpdfs.show',                            



                    ]) }}">
                    <a href="javascript:void(0)" class="nav-link {{ $checker->route->areOnRoutes([
                         'admin.events.index','admin.events.show','admin.events.create',                         
                         'admin.eventtypes.index','admin.eventtypes.show','admin.eventtypes.create',
                         'admin.eventinformations.index','admin.eventinformations.show','admin.eventinformations.create',
                         'admin.eventcarousels.index','admin.eventcarousels.show','admin.eventcarousels.create',
                         'admin.previousguests.index','admin.previousguests.show','admin.previousguests.create',
                         'admin.eventpdfs.index','admin.eventpdfs.create','admin.eventpdfs.show',                            


                    ]) }}">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                            Event Content Management
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
            <ul class="nav nav-treeview">
                @if ($self->hasAnyPermission(['admin.events.crud']))             
                <li class="nav-item">
                    <a href="{{ route('admin.events.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.events.index','admin.events.show','admin.events.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Events
                        </p>
                    </a>
                </li>         
                @endif
                @if ($self->hasAnyPermission(['admin.eventtypes.crud']))             
                <li class="nav-item">
                    <a href="{{ route('admin.eventtypes.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.eventtypes.index','admin.eventtypes.show','admin.eventtypes.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Event Types
                        </p>
                    </a>
                </li>                
                @endif
                {{-- @if ($self->hasAnyPermission(['admin.eventinformations.crud']))             
                <li class="nav-item">
                    <a href="{{ route('admin.eventinformations.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.eventinformations.index','admin.eventinformations.show','admin.eventinformations.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Event Informations
                        </p>
                    </a>
                </li>                        
                @endif --}}
                @if ($self->hasAnyPermission(['admin.eventcarousels.crud']))                                     
                <li class="nav-item">
                    <a href="{{ route('admin.eventcarousels.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.eventcarousels.index','admin.eventcarousels.show','admin.eventcarousels.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Event Carousels
                        </p>
                    </a>
                </li>
                @endif
                @if ($self->hasAnyPermission(['admin.previousguests.crud']))                                                     
                <li class="nav-item">
                    <a href="{{ route('admin.previousguests.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.previousguests.index','admin.previousguests.show','admin.previousguests.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Previous Guests
                        </p>
                    </a>
                </li>     
                @endif   
                @if ($self->hasAnyPermission(['admin.eventpdfs.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.eventpdfs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.eventpdfs.index','admin.eventpdfs.show','admin.eventpdfs.create'
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Event Contents Pdf 
                        </p>
                    </a>
                </li>
                @endif                        
            </ul>
        </li>                            
        @endif
            
        @if ($self->hasAnyPermission(['admin.collaborators.crud', 'admin.researches.crud', 'admin.informationkits.crud','admin.galleries.crud','admin.declarations.crud',]))
        <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                    'admin.collaborators.index','admin.researches.index','admin.informationkits.index','admin.galleries.index','admin.declarations.index',
                    'admin.collaborators.show','admin.researches.show','admin.informationkits.show','admin.galleries.show','admin.declarations.show',
                    'admin.collaborators.create','admin.researches.create','admin.informationkits.create','admin.galleries.create',
                    'admin.declarations.create',
                ]) }}">
                <a href="javascript:void(0)" class="nav-link {{ $checker->route->areOnRoutes([
                    'admin.collaborators.index','admin.researches.index','admin.informationkits.index','admin.galleries.index','admin.declarations.index'
                ]) }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>
                        More Content Management
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
            <ul class="nav nav-treeview">   
              @if ($self->hasAnyPermission(['admin.galleries.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.galleries.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.galleries.index','admin.galleries.show','admin.galleries.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
              @endif
              @if ($self->hasAnyPermission(['admin.collaborators.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.collaborators.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.collaborators.index','admin.collaborators.show','admin.collaborators.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Project And Collaborators
                        </p>
                    </a>
                </li>
              @endif
              @if ($self->hasAnyPermission(['admin.researches.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.researches.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.researches.index','admin.researches.show','admin.researches.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Researches
                        </p>
                    </a>
                </li> 
              @endif
              @if ($self->hasAnyPermission(['admin.experience-information.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.informationkits.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.informationkits.index','admin.informationkits.show','admin.informationkits.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Information Kits
                        </p>
                    </a>
                </li>
               @endif                                               
               @if ($self->hasAnyPermission(['admin.declarations.crud']))
                <li class="nav-item">
                    <a href="{{ route('admin.declarations.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                        'admin.declarations.index','admin.declarations.show','admin.declarations.create',
                    ]) }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>
                            Declarations
                        </p>
                    </a>
                </li>
               @endif 
            </ul>    
        </li>

            @if ($self->hasAnyPermission(['admin.pages.crud', 'admin.page-items.crud', 'admin.articles.crud', 'admin.venues.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.pages.index','admin.pages.create','admin.pages.show',
                            'admin.page-items.index','admin.page-items.create','admin.page-items.show',
                            'admin.articles.index','admin.articles.create','admin.articles.show',
                            'admin.articles.index','admin.articles.create','admin.articles.show',
                            'admin.georeservepolicies.index','admin.georeservepolicies.create','admin.georeservepolicies.show',
                            'admin.add-ons.index','admin.add-ons.create','admin.add-ons.show',                            
                            'admin.faqs.index','admin.faqs.create','admin.faqs.show',
                            'admin.pdflinks.index','admin.pdflinks.create','admin.pdflinks.show',
                            'admin.venues.index','admin.venues.create','admin.venues.show',

                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Content Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.pages.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.pages.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.pages.index','admin.pages.create','admin.pages.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Pages
                                        </p>
                                    </a>
                                </li>
                            @endif
                            
                            @if ($self->hasAnyPermission(['admin.page-items.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.page-items.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.page-items.index','admin.page-items.create','admin.page-items.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Page Items
                                        </p>
                                    </a>
                                </li>
                            @endif

                            {{-- @if ($self->hasAnyPermission(['admin.articles.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.articles.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.articles.index','admin.articles.create','admin.articles.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Articles
                                        </p>
                                    </a>
                                </li>
                            @endif --}}
                            @if ($self->hasAnyPermission(['admin.georeservepolicies.crud']))

                            <li class="nav-item">
                                <a href="{{ route('admin.georeservepolicies.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.georeservepolicies.index','admin.georeservepolicies.create','admin.georeservepolicies.show',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Georeserve Policies
                                    </p>
                                </a>
                            </li>
                           
                           @endif
                           @if ($self->hasAnyPermission(['admin.add_ons.crud']))
                            <li class="nav-item">
                                <a href="{{ route('admin.add-ons.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.add-ons.index','admin.add-ons.create','admin.add-ons.show',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Complimentary Snacks
                                    </p>
                                </a>
                            </li>

                            @endif
                            {{-- @if ($self->hasAnyPermission(['admin.faqs.crud']))                            
                                 <li class="nav-item">
                                    <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.faqs.index','admin.faqs.create','admin.faqs.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            FAQs
                                        </p>
                                    </a>
                                </li>
                            @endif --}}
                            @if ($self->hasAnyPermission(['admin.pdflinks.crud']))                            
                                 <li class="nav-item">
                                    <a href="{{ route('admin.pdflinks.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.pdflinks.index','admin.pdflinks.create','admin.pdflinks.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Pdf Links
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if ($self->hasAnyPermission(['admin.venues.crud']))                            
                                 <li class="nav-item">
                                    <a href="{{ route('admin.venues.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.venues.index','admin.venues.create','admin.venues.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Venues
                                        </p>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.home-banners.crud', 'admin.news.crud', 'admin.awards.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.home-banners.index','admin.home-banners.create','admin.home-banners.show','admin.news.index','admin.news.create','admin.news.show','admin.awards.index','admin.awards.create','admin.awards.show','admin.features.index','admin.features.create','admin.features.show',                                    'admin.oldnewcarousels.index','admin.oldnewcarousels.show','admin.oldnewcarousels.create',


                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link {{ $checker->route->areOnRoutes([
                            
                        ]) }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home Contents Carousels
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                      <ul class="nav nav-treeview">                        
                            @if ($self->hasAnyPermission(['admin.home-banners.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.home-banners.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.home-banners.index','admin.home-banners.create','admin.home-banners.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>

                                            Home Banners

                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($self->hasAnyPermission(['admin.oldnewcarousels.crud']))                            
                            <li class="nav-item">
                                <a href="{{ route('admin.oldnewcarousels.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.oldnewcarousels.index','admin.oldnewcarousels.show','admin.oldnewcarousels.create',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Old New Masungi Carousels
                                    </p>
                                </a>
                            </li>   
                            @endif                            
                            @if ($self->hasAnyPermission(['admin.news.crud']))                                                        
                                <li class="nav-item">
                                    <a href="{{ route('admin.news.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.news.index','admin.news.create','admin.news.show',
                                       ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            News
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($self->hasAnyPermission(['admin.awards.crud']))                            
                                <li class="nav-item">
                                    <a href="{{ route('admin.awards.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.awards.index','admin.awards.create','admin.awards.show',
                                       ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Awards
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($self->hasAnyPermission(['admin.features.crud']))                            
                                <li class="nav-item">
                                    <a href="{{ route('admin.features.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.features.index','admin.features.create','admin.features.show',
                                       ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Features
                                        </p>
                                    </a>
                                </li>                                   
                            @endif       
                    {{--    <li class="nav-item">
                                <a href="{{ route('admin.experiencecarousels.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.experiencecarousels.index',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Experience Carousels
                                    </p>
                                </a>
                            </li> --}}                                                        
                       </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.weddingpdfs.crud', 'admin.weddingvenues.crud', 'admin.weddingboards.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.weddingpdfs.index','admin.weddingpdfs.create','admin.weddingpdfs.show',
                            'admin.weddingvenues.index','admin.weddingvenues.create','admin.weddingvenues.show',
                            'admin.weddingboards.index','admin.weddingboards.create','admin.weddingboards.show',

                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.weddingpdfs.index','admin.weddingpdfs.create','admin.weddingpdfs.show',
                            'admin.weddingvenues.index','admin.weddingvenues.create','admin.weddingvenues.show',
                            'admin.weddingboards.index','admin.weddingboards.create','admin.weddingboards.show',
                            
                        ]) }}">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>
                                Wedding Carousels
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">                        
                            @if ($self->hasAnyPermission(['admin.weddingpdfs.crud']))                            
                            <li class="nav-item">
                                <a href="{{ route('admin.weddingpdfs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.weddingpdfs.index','admin.weddingpdfs.create','admin.weddingpdfs.show',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Weddings Pdf
                                    </p>
                                </a>
                            </li>
                            @endif
                            @if ($self->hasAnyPermission(['admin.weddingvenues.crud']))                            
                            <li class="nav-item">
                                <a href="{{ route('admin.weddingvenues.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.weddingvenues.index','admin.weddingvenues.create','admin.weddingvenues.show',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Wedding Venues
                                    </p>
                                </a>
                            </li>
                            @endif
                            @if ($self->hasAnyPermission(['admin.weddingboards.crud']))
                            <li class="nav-item">
                                <a href="{{ route('admin.weddingboards.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.weddingboards.index','admin.weddingboards.create','admin.weddingboards.show',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Wedding Boards
                                    </p>
                                </a>
                            </li>
                            @endif                
                        </ul>
                    </li>
                @endif

                @if ($self->hasAnyPermission(['admin.home-banners.crud', 'admin.news.crud', 'admin.awards.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.beyondmasungi.index','admin.beyondmasungi.show','admin.beyondmasungi.create',
                            'admin.destinationcarousel.index','admin.destinationcarousel.create','admin.destinationcarousel.show',

                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.beyondmasungi.index','admin.beyondmasungi.show','admin.beyondmasungi.create',
                            'admin.destinationcarousel.index','admin.destinationcarousel.create','admin.destinationcarousel.show',

                        ]) }}">
                            <i class="nav-icon far fa-map"></i>
                            <p>
                                Destination Carousels
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">                        
                            @if ($self->hasAnyPermission(['admin.weddingboards.crud']))                            
                            <li class="nav-item">
                                <a href="{{ route('admin.beyondmasungi.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                    'admin.beyondmasungi.index','admin.beyondmasungi.show','admin.beyondmasungi.create',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Beyond Masungi Carousel
                                    </p>
                                </a>
                            </li>         
                            @endif
                            @if ($self->hasAnyPermission(['admin.destinationcarousel.crud']))                            
                            <li class="nav-item">
                                <a href="{{ route('admin.destinationcarousel.index') }}" class="nav-link {{ $checker->route->areOnRoutes([ 
                                    'admin.destinationcarousel.index','admin.destinationcarousel.create','admin.destinationcarousel.show',
                                ]) }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Destination Carousel
                                    </p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif                                                        
                     
                @if ($self->hasAnyPermission(['admin.admin-users.crud', 'admin.roles.crud', 'admin.users.crud', 'admin.activity-logs.crud']))
                    <li class="nav-header">Admin Management</li>
                @endif

                @if ($self->hasAnyPermission(['admin.admin-users.crud', 'admin.roles.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.admin-users.index','admin.admin-users.create','admin.admin-users.show',
                            'admin.roles.index', 'admin.roles.create', 'admin.roles.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>
                                Admin Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.admin-users.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.admin-users.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.admin-users.index','admin.admin-users.create','admin.admin-users.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Admins
                                        </p>
                                    </a>
                                </li>
                            @endif

                            @if ($self->hasAnyPermission(['admin.roles.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.roles.index', 'admin.roles.create', 'admin.roles.show'
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Roles & Permissions
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- @if ($self->hasAnyPermission(['admin.users.crud']))
                    <li class="nav-item has-treeview {{ $checker->route->areOnRoutes([
                            'admin.users.index','admin.users.create','admin.users.show',
                        ]) }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Management
                                <i class="right fa fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($self->hasAnyPermission(['admin.users.crud']))
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                                        'admin.users.index','admin.users.create','admin.users.show',
                                    ]) }}">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Users
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
 --}}
                @if ($self->hasAnyPermission(['admin.activity-logs.crud']))
                    <li class="nav-item">
                        <a href="{{ route('admin.activity-logs.index') }}" class="nav-link {{ $checker->route->areOnRoutes([
                            'admin.activity-logs.index',
                        ]) }}">
                            <i class="nav-icon fa fa-file-alt"></i>
                            <p>
                                Activity Logs
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        @endif
    </div>
</aside>