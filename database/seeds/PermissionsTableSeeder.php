<?php

use Illuminate\Database\Seeder;

use App\Models\Permissions\PermissionCategory;
use App\Models\Permissions\Permission;

class PermissionsTableSeeder     extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sample Item Management',
                'description' => 'Manage Sample Items',
                'icon' => 'fa fa-cubes',
                'items' => [
                    [
                        'name' => 'admin.sample-items.crud',
                        'description' => 'Manage Sample Items',
                    ],
                ],
            ],
            [
                'name' => 'Content Management',
                'description' => 'Manage Pages & Contents',
                'icon' => 'fa fa-feather',
                'items' => [
                    [
                        'name' => 'admin.pages.crud',
                        'description' => 'Manage Pages',
                    ],
                    [
                        'name' => 'admin.page-items.crud',
                        'description' => 'Manage Page Contents',
                    ],
                    [
                        'name' => 'admin.articles.crud',
                        'description' => 'Manage Articles',
                    ],
                ],
            ],
            [
                'name' => 'Times-Slots Management',
                'description' => 'Manage Times-Slots',
                'icon' => 'fa fa-clock',
                'items' => [
                    [
                        'name' => 'admin.time-slots.crud',
                        'description' => 'Manage Times-Slots',
                    ],

                ],
            ],

            [
                'name' => 'Bankdetail Management',
                'description' => 'Manage Bankdetail',
                'icon' => 'fa fa-feather',
                'items' => [
                    [
                        'name' => 'admin.bankdetails.crud',
                        'description' => 'Manage Bankdetail',
                    ],

                ],
            ],


            [
                'name' => 'Carousels',
                'description' => 'Manage Page Carousels',
                'icon' => 'fa fa-feather',
                'items' => [
                    [
                        'name' => 'admin.home-banners.crud',
                        'description' => 'Manage Carousels',
                    ],
                ],
            ],
            [
                'name' => 'Tabbings',
                'description' => 'Manage Tabbings',
                'icon' => 'fa fa-feather',
                'items' => [
                    [
                        'name' => 'admin.about-infos.crud',
                        'description' => 'Manage About Tabbings',
                    ],
                ],
            ],
            [
                'name' => 'Admin Management',
                'description' => 'Manage Administrators',
                'icon' => 'fa fa-user-shield',
                'items' => [
                    [
                        'name' => 'admin.admin-users.crud',
                        'description' => 'Manage Administrator Accounts',
                    ],
                    [
                        'name' => 'admin.roles.crud',
                        'description' => 'Manage Admin Roles & Permissions',
                    ],
                ],
            ],
            [
                'name' => 'User Management',
                'description' => 'Manage User Accounts',
                'icon' => 'fa fa-users',
                'items' => [
                    [
                        'name' => 'admin.users.crud',
                        'description' => 'Manage User Accounts',
                    ],
                ],
            ],
            [
                'name' => 'Activity Logs',
                'description' => 'View Activity Logs',
                'icon' => 'fa fa-shield-alt',
                'items' => [
                    [
                        'name' => 'admin.activity-logs.crud',
                        'description' => 'View Activity Logs',
                    ],
                ],
            ],

            [
                'name' => 'Allocations',
                'description' => 'Manage Allocations',
                'icon' => 'fas fa-hiking',
                'items' => [
                    [
                        'name' => 'admin.allocations.crud',
                        'description' => 'Manage Allocations',
                    ],
                ],
            ],
            [
                'name' => 'Destinations',
                'description' => 'Manage Destinations',
                'icon' => 'fas fa-map-marked-alt',
                'items' => [
                    [
                        'name' => 'admin.destinations.crud',
                        'description' => 'Manage Destinations',
                    ],
                ],
            ],
            [
                'name' => 'Experiences',
                'description' => 'Manage Experiences',
                'icon' => 'fas fa-hiking',
                'items' => [
                    [
                        'name' => 'admin.experiences.crud',
                        'description' => 'Manage Experiences',
                    ],
                ],
            ],
            [
                'name' => 'Trails',
                'description' => 'Manage Trails',
                'icon' => 'fas fa-hiking',
                'items' => [
                    [
                        'name' => 'admin.trails.crud',
                        'description' => 'Manage Trails',
                    ],
                ],
            ],            
            [
                'name' => 'Experience Information',
                'description' => 'Manage Experiences',
                'icon' => 'fas fa-hiking',
                'items' => [
                    [
                        'name' => 'admin.experience-information.crud',
                        'description' => 'Manage Experiences Information',             
                    ],
                ],
            ],
      
            [
                'name' => 'Manage Awards',
                'description' => 'Manage Awards',
                'icon' => 'fas fa-hiking',
                'items' => [
                    [
                        'name' => 'admin.awards.crud',
                        'description' => 'Manage Award Information',             
                    ],
                ],
            ],

            [
                'name' => 'Manage Features',
                'description' => 'Manage Features',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.features.crud',
                        'description' => 'Manage Features Information',             
                    ],
                ],
            ],            

            [
                'name' => 'Manage Beyond Masungi Content',
                'description' => 'Manage Beyond Masungi Content',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.beyondmasungi.crud',
                        'description' => 'Manage Beyond Masungi Content',             
                    ],
                ],
            ],            

            [
                'name' => 'Manage Destination Carousel',
                'description' => 'Manage Destination Carousel',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.destinationcarousel.crud',
                        'description' => 'Manage Destination Carousel',             
                    ],
                ],
            ],

            [
                'name' => 'Manage Previous Guests',
                'description' => 'Manage Previous Guests',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.previousguests.crud',
                        'description' => 'Manage Previous Guests',             
                    ],
                ],
            ],

            [
                'name' => 'Manage Collaborators',
                'description' => 'Manage Collaborators',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.collaborators.crud',
                        'description' => 'Manage Collaborators',             
                    ],
                ],
            ],

            [
                'name' => 'Manage Researches',
                'description' => 'Manage Researches',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.researches.crud',
                        'description' => 'Manage Researches',             
                    ],
                ],
            ],

            [
                'name' => 'Manage Information Kits',
                'description' => 'Manage Information Kits',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.informationkits.crud',
                        'description' => 'Manage Information Kits',             
                    ],
                ],
            ],                                                    

            [
                'name' => 'Manage Gallery',
                'description' => 'Manage Gallery',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.galleries.crud',
                        'description' => 'Manage Gallery',             
                    ],
                ],
            ],                                                                

            [
                'name' => 'Manage Declarations',
                'description' => 'Manage Declarations',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.declarations.crud',
                        'description' => 'Manage Declarations',             
                    ],
                ],
            ],

            [
                'name' => 'Manage Trail Stops',
                'description' => 'Manage Trail Stops',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.trailstops.crud',
                        'description' => 'Manage Trail Stops',
                    ],
                ],
            ],

            [
                'name' => 'Manage Wedding Pdf',
                'description' => 'Manage Wedding Pdf',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.weddingpdfs.crud',
                        'description' => 'Manage Wedding Pdf',
                    ],
                ],
            ],

            [
                'name' => 'Manage Event Pdf',
                'description' => 'Manage Event Pdf',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.eventpdfs.crud',
                        'description' => 'Manage Event Pdf',
                    ],
                ],
            ],              

            [
                'name' => 'Manage Pdf Links',
                'description' => 'Manage Pdf Links',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.pdflinks.crud',
                        'description' => 'Manage Pdf Links',
                    ],
                ],
            ],

            [
                'name' => 'Manage Wedding Venues',
                'description' => 'Manage Wedding Venues',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.weddingvenues.crud',
                        'description' => 'Manage Wedding Venues',
                    ],
                ],
            ],

            [
                'name' => 'Manage Venues',
                'description' => 'Manage Venues',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.venues.crud',
                        'description' => 'Manage Venues',
                    ],
                ],
            ],

            [
                'name' => 'Manage Wedding Boards',
                'description' => 'Manage Wedding Boards',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.weddingboards.crud',   
                        'description' => 'Manage Wedding Boards',
                    ],
                ],
            ],

            [
                'name' => 'Manage Events',
                'description' => 'Manage Events',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.events.crud',   
                        'description' => 'Manage Events',
                    ],
                ],
            ],

            [
                'name' => 'Manage Event Types',
                'description' => 'Manage Event Types',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.eventtypes.crud',   
                        'description' => 'Manage Event Types',
                    ],
                ],
            ],

            [
                'name' => 'Manage Event Informations',
                'description' => 'Manage Event Informations',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.eventinformations.crud',   
                        'description' => 'Manage Event Informations',
                    ],
                ],
            ],  

            [
                'name' => 'Manage Event Carousels',
                'description' => 'Manage Event Carousels',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.eventcarousels.crud',   
                        'description' => 'Manage Event Carousels',
                    ],
                ],
            ],                                  

            [
                'name' => 'Manage Home Old New Masungi Carousels',
                'description' => 'Manage Home Old New Masungi Carousels',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.oldnewcarousels.crud',   
                        'description' => 'Manage Home Old New Masungi Carousels',
                    ],
                ],
            ],

            [
                'name' => 'Manage Home Experience Carousels',
                'description' => 'Manage Home Experience Carousels',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.experiencecarousels.crud',   
                        'description' => 'Manage Home Experience Carousels',
                    ],
                ],
            ],                                  

            [
                'name' => 'Contact Us',
                'description' => 'View Contact Us',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.contactus.crud',
                        'description' => 'View Contact Us',
                    ],
                ],
            ],

            [
                'name' => 'Company Event Inquiries',
                'description' => 'View Company Event Inquiries',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.companyinquiries.crud',
                        'description' => 'View Company Event Inquiries',
                    ],
                ],
            ],            

            [
                'name' => 'School Event Inquiries',
                'description' => 'View School Event Inquiries',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.schoolinquiries.crud',
                        'description' => 'View School Event Inquiries',
                    ],
                ],
            ],

            [
                'name' => 'Wedding Event Inquiries',
                'description' => 'View Wedding Event Inquiries',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.weddinginquiries.crud',
                        'description' => 'View Wedding Event Inquiries',
                    ],
                ],
            ],            

            [
                'name' => ' Manage Georeserve Policies',
                'description' => 'Georeserve Policies',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.georeservepolicies.crud',
                        'description' => 'Georeserve Policies',
                    ],
                ],
            ],            

            [
                'name' => ' Manage Newsletters Subscribers',
                'description' => 'Newsletters Subscribers',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.newsletters.crud',
                        'description' => 'Newsletters Subscribers',
                    ],
                ],
            ],                        

            [
                'name' => 'Add Ons',
                'description' => 'Manage Add Ons',
                'icon' => 'fas fa-plus-square',
                'items' => [
                    [
                        'name' => 'admin.add_ons.crud',
                        'description' => 'Manage Add Ons',
                    ],
                ],
            ],

            [
                'name' => 'Blocked Dates',
                'description' => 'Manage Blocked Dates',
                'icon' => 'fas fa-user-friends',
                'items' => [
                    [
                        'name' => 'admin.blocked-dates.crud',
                        'description' => 'Manage Blocked Dates',
                    ],
                ],
            ],

            [
                'name' => 'Capacities',
                'description' => 'Manage Capacities',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.capacities.crud',
                        'description' => 'Manage Capacities',
                    ],
                ],
            ],

            [
                'name' => 'News',
                'description' => 'Manage News',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.news.crud',
                        'description' => 'Manage News',
                    ],
                ],
            ],

            [
                'name' => 'Faqs',
                'description' => 'Manage Faqs',
                'icon' => 'fas fa-at',
                'items' => [
                    [
                        'name' => 'admin.faqs.crud',
                        'description' => 'Manage Faqs',
                    ],
                ],
            ],

        ];

    	foreach ($categories as $category) {
            $permissions = $category['items'];
            unset($category['items']);

            $item = PermissionCategory::where('name', $category['name'])->first();

            if (!$item) {
                $this->command->info('Adding permission category ' . $category['name'] . '...');
                $item = PermissionCategory::create($category);
            } else {
                $this->command->warn('Updating permission category ' . $category['name'] . '...');
                $item->update($category);
            }


            foreach ($permissions as $permission) {
                $permissionItem = Permission::where('name', $permission['name'])->first();
                
                if (!$permissionItem) {
                    $this->command->info('Adding permission ' . $permission['name'] . '...');
                    $item->permissions()->create($permission);
                } else {
                    $this->command->warn('Updating permission ' . $permission['name'] . '...');
                    unset($permission['name']);
                    $permissionItem->update($permission);
                }
            }
    	}
    }
}
