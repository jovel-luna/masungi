<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
/* Login Page*/

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function() {

    Route::namespace('Auth')->middleware('guest:admin')->group(function() {

        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login')->name('login');

        Route::get('reset-password/{token}/{email}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('reset-password/change', 'ResetPasswordController@reset')->name('password.change');

        Route::get('forgot-password', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('forgot-password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    });

    Route::middleware('auth:admin')->group(function() {

        Route::post('sortable', 'SortableController@sort')->name('sortable');
        Route::post('sortable?image=1', 'SortableController@sort')->name('sort.image');

        Route::namespace('Auth')->group(function() {

            Route::get('logout', 'LoginController@logout')->name('logout');

        });

        Route::get('', 'DashboardController@index')->name('dashboard');

        Route::post('fetch/address-position', '\App\Http\Controllers\GoogleAPIController@fetchAddressPosition')->name('google.fetch.address-position');

        /**
         * @Count Fetch Controller
         */
        Route::post('count/notifications', 'CountFetchController@fetchNotificationCount')->name('counts.fetch.notifications');
        Route::post('count/sample-items', 'CountFetchController@fetchSampleItemCount')->name('counts.fetch.sample-items.pending');
        
        /**
         * @Analytics
         */
        Route::namespace('Analytics')->group(function() {

            Route::post('analytics/dashboard', 'DashboardAnalyticsController@fetch')->name('analytics.fetch.user');
            Route::post('analytics/dashboard?admin=1', 'DashboardAnalyticsController@fetch')->name('analytics.fetch.admin');

        });

        Route::namespace('Profiles')->group(function() {

            /**
             * @Admin Profiles
             */
            Route::get('profile', 'ProfileController@show')->name('profiles.show');
            Route::post('profile/update', 'ProfileController@update')->name('profiles.update');
            Route::post('profile/change-password', 'ProfileController@changePassword')->name('profiles.change-password');

            Route::post('profile/fetch', 'ProfileController@fetch')->name('profiles.fetch');

        });

        /**
         * @AdminUsers
         */
        Route::namespace('AdminUsers')->group(function() {

            /**
             * @AdminUsers
             */
            Route::get('admin-users', 'AdminUserController@index')->name('admin-users.index');
            Route::get('admin-users/create', 'AdminUserController@create')->name('admin-users.create');
            Route::post('admin-users/store', 'AdminUserController@store')->name('admin-users.store');
            Route::get('admin-users/show/{id}', 'AdminUserController@show')->name('admin-users.show');
            Route::post('admin-users/update/{id}', 'AdminUserController@update')->name('admin-users.update');
            Route::post('admin-users/{id}/archive', 'AdminUserController@archive')->name('admin-users.archive');
            Route::post('admin-users/{id}/restore', 'AdminUserController@restore')->name('admin-users.restore');

            Route::post('admin-users/fetch', 'AdminUserFetchController@fetch')->name('admin-users.fetch');
            Route::post('admin-users/fetch?archived=1', 'AdminUserFetchController@fetch')->name('admin-users.fetch-archive');
            Route::post('admin-users/fetch-item/{id?}', 'AdminUserFetchController@fetchView')->name('admin-users.fetch-item');
            Route::post('admin-users/fetch-pagination/{id}', 'AdminUserFetchController@fetchPagePagination')->name('admin-users.fetch-pagination');

        });

        /**
         * @Users
         */
        Route::namespace('Users')->group(function() {

            /**
             * @AdminUsers
             */
            Route::get('users', 'UserController@index')->name('users.index');
            Route::get('users/create', 'UserController@create')->name('users.create');
            Route::post('users/store', 'UserController@store')->name('users.store');
            Route::get('users/show/{id}', 'UserController@show')->name('users.show');
            Route::post('users/update/{id}', 'UserController@update')->name('users.update');
            Route::post('users/{id}/archive', 'UserController@archive')->name('users.archive');
            Route::post('users/{id}/restore', 'UserController@restore')->name('users.restore');

            Route::post('users/fetch', 'UserFetchController@fetch')->name('users.fetch');
            Route::post('users/fetch?archived=1', 'UserFetchController@fetch')->name('users.fetch-archive');
            Route::post('users/fetch-item/{id?}', 'UserFetchController@fetchView')->name('users.fetch-item');
            Route::post('users/fetch-pagination/{id}', 'UserFetchController@fetchPagePagination')->name('users.fetch-pagination');

        });

        /**
         * CMS Pages
         */
        Route::namespace('Pages')->group(function() {

            Route::get('pages', 'PageController@index')->name('pages.index');
            Route::get('pages/create', 'PageController@create')->name('pages.create');
            Route::post('pages/store', 'PageController@store')->name('pages.store');
            Route::get('pages/show/{id}', 'PageController@show')->name('pages.show');
            Route::post('pages/update/{id}', 'PageController@update')->name('pages.update');
            Route::post('pages/{id}/archive', 'PageController@archive')->name('pages.archive');
            Route::post('pages/{id}/restore', 'PageController@restore')->name('pages.restore');

            Route::post('pages/fetch', 'PageFetchController@fetch')->name('pages.fetch');
            Route::post('pages/fetch?archived=1', 'PageFetchController@fetch')->name('pages.fetch-archive');
            Route::post('pages/fetch-item/{id?}', 'PageFetchController@fetchView')->name('pages.fetch-item');
            Route::post('pages/fetch-pagination/{id}', 'PageFetchController@fetchPagePagination')->name('pages.fetch-pagination');

            Route::get('page-items', 'PageItemController@index')->name('page-items.index');
            Route::get('page-items/create', 'PageItemController@create')->name('page-items.create');
            Route::post('page-items/store', 'PageItemController@store')->name('page-items.store');
            Route::get('page-items/show/{id}', 'PageItemController@show')->name('page-items.show');
            Route::post('page-items/update/{id}', 'PageItemController@update')->name('page-items.update');
            Route::post('page-items/{id}/archive', 'PageItemController@archive')->name('page-items.archive');
            Route::post('page-items/{id}/restore', 'PageItemController@restore')->name('page-items.restore');

            Route::post('page-items/fetch', 'PageItemFetchController@fetch')->name('page-items.fetch');
            Route::post('page-items/fetch?archived=1', 'PageItemFetchController@fetch')->name('page-items.fetch-archive');
            Route::post('page-items/fetch?page_id={id}', 'PageItemFetchController@fetch')->name('page-items.fetch-page-items');
            Route::post('page-items/fetch-item/{id?}', 'PageItemFetchController@fetchView')->name('page-items.fetch-item');
            Route::post('page-items/fetch-pagination/{id}', 'PageItemFetchController@fetchPagePagination')->name('page-items.fetch-pagination');

        });

        /**
         * @Roles
         */
        Route::namespace('Roles')->group(function() {

            Route::get('roles', 'RoleController@index')->name('roles.index');
            Route::get('roles/create', 'RoleController@create')->name('roles.create');
            Route::post('roles/store', 'RoleController@store')->name('roles.store');
            Route::get('roles/{id}', 'RoleController@show')->name('roles.show');
            Route::post('roles/{id}/update', 'RoleController@update')->name('roles.update');
            Route::post('roles/{id}/archive', 'RoleController@archive')->name('roles.archive');
            Route::post('roles/{id}/restore', 'RoleController@restore')->name('roles.restore');

            Route::post('roles/{id}/update-permission', 'RoleController@updatePermissions')->name('roles.update-permissions');

            Route::post('roles/fetch', 'RoleFetchController@fetch')->name('roles.fetch');
            Route::post('roles/fetch?archived=1', 'RoleFetchController@fetch')->name('roles.fetch-archive');
            Route::post('roles/fetch-item/{id?}', 'RoleFetchController@fetchView')->name('roles.fetch-item');
            Route::post('role/fetch-pagination/{id}', 'RoleFetchController@fetchPagePagination')->name('roles.fetch-pagination');

        });

        /**
         * @Permissions
         */
        Route::namespace('Permissions')->group(function() {

            Route::post('permissions-fetch/{id?}', 'PermissionFetchController@fetch')->name('permissions.fetch');

        });

        Route::namespace('Notifications')->group(function() {

            Route::get('notifications', 'NotificationController@index')->name('notifications.index');
            Route::post('notifications/all/mark-as-read', 'NotificationController@readAll')->name('notifications.read-all');
            Route::post('notifications/{id}/read', 'NotificationController@read')->name('notifications.read');
            Route::post('notifications/{id}/unread', 'NotificationController@unread')->name('notifications.unread');
            
            Route::post('notifications-fetch', 'NotificationFetchController@fetch')->name('notifications.fetch');
            Route::post('notifications-fetch?read=1', 'NotificationFetchController@fetch')->name('notifications.fetch-read');
            Route::post('notifications-fetch?unread=1', 'NotificationFetchController@fetch')->name('notifications.fetch-unread');

            Route::post('notifications/fetch?id={id?}&companyinquiries=1', 'NotificationFetchController@fetch')->name('notifications.fetch.companyinquiries');


        });

        Route::namespace('ActivityLogs')->group(function() {

            Route::get('activity-logs', 'ActivityLogController@index')->name('activity-logs.index');
            Route::post('activity-logs/fetch', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch');

            Route::post('activity-logs/fetch?id={id?}&sample=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.sample-items');

            Route::post('activity-logs/fetch?id={id?}&admin=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.admin-users');
            Route::post('activity-logs/fetch?id={id?}&user=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.users');

            Route::post('activity-logs/fetch?profile=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.profiles');

            Route::post('activity-logs/fetch?id={id?}&roles=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.roles');

            Route::post('activity-logs/fetch?id={id?}&pagecontents=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.pages');
            Route::post('activity-logs/fetch?id={id?}&pageitems=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.page-items');

            Route::post('activity-logs/fetch?id={id?}&articles=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.articles');

            Route::post('activity-logs/fetch?id={id?}&faqs=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.faqs');

            Route::post('activity-logs/fetch?id={id?}&home-banners=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.home-banners');

            Route::post('activity-logs/fetch?id={id?}&add-ons=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.add-ons');

            Route::post('activity-logs/fetch?id={id?}&experience-information=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.experience-information');

            Route::post('activity-logs/fetch?id={id?}&experiences=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.experiences');

            Route::post('activity-logs/fetch?id={id?}&trails=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.trails');
            Route::post('activity-logs/fetch?id={id?}&time-slots=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.time-slots');

            Route::post('activity-logs/fetch?id={id?}&news=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.news');

            Route::post('activity-logs/fetch?id={id?}&capacities=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.capacities');

            Route::post('activity-logs/fetch?id={id?}&awards=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.awards');

            Route::post('activity-logs/fetch?id={id?}&features=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.features');

            Route::post('activity-logs/fetch?id={id?}&beyondmasungi=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.beyondmasungi');

            Route::post('activity-logs/fetch?id={id?}&destinationcarousel=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.destinationcarousel');
            
            Route::post('activity-logs/fetch?id={id?}&previousguests=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.previousguests');

            Route::post('activity-logs/fetch?id={id?}&collaborators=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.collaborators');                        
       
            Route::post('activity-logs/fetch?id={id?}&researches=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.researches');

            Route::post('activity-logs/fetch?id={id?}&informationkits=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.informationkits');

            Route::post('activity-logs/fetch?id={id?}&galleries=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.galleries');

            Route::post('activity-logs/fetch?id={id?}&trailstops=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.trailstops');

            Route::post('activity-logs/fetch?id={id?}&weddingvenues=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.weddingvenues');

            Route::post('activity-logs/fetch?id={id?}&weddingboards=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.weddingboards');

            Route::post('activity-logs/fetch?id={id?}&events=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.events');

            Route::post('activity-logs/fetch?id={id?}&eventtypes=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.eventtypes');

            Route::post('activity-logs/fetch?id={id?}&eventinformations=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.eventinformations');

            Route::post('activity-logs/fetch?id={id?}&eventcarousels=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.eventcarousels');

            Route::post('activity-logs/fetch?id={id?}&oldnewcarousels=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.oldnewcarousels');

            Route::post('activity-logs/fetch?id={id?}&experiencecarousels=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.experiencecarousels');

            Route::post('activity-logs/fetch?id={id?}&contactus=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.contactus');

            Route::post('activity-logs/fetch?id={id?}&companyinquiries=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.companyinquiries');

            Route::post('activity-logs/fetch?id={id?}&schoolinquiries=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.schoolinquiries');

            Route::post('activity-logs/fetch?id={id?}&weddinginquiries=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.weddinginquiries');    

            Route::post('activity-logs/fetch?id={id?}&declarations=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.declarations');            

            Route::post('activity-logs/fetch?id={id?}&georeservepolicies=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.georeservepolicies');            

            Route::post('activity-logs/fetch?id={id?}&newsletters=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.newsletters');            

            Route::post('activity-logs/fetch?id={id?}&weddingpdfs=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.weddingpdfs');            
           
            Route::post('activity-logs/fetch?id={id?}&eventpdfs=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.eventpdfs');            

            Route::post('activity-logs/fetch?id={id?}&pdflinks=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.pdflinks');            

            Route::post('activity-logs/fetch?id={id?}&bankdetails=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.bankdetails');

            Route::post('activity-logs/fetch?id={id?}&venues=1', 'ActivityLogFetchController@fetch')->name('activity-logs.fetch.venues');

        });

        Route::namespace('Articles')->group(function() {
            Route::get('articles', 'ArticleController@index')->name('articles.index');
            Route::get('articles/create', 'ArticleController@create')->name('articles.create');
            Route::post('articles/store', 'ArticleController@store')->name('articles.store');
            Route::get('articles/show/{id}', 'ArticleController@show')->name('articles.show');
            Route::post('articles/update/{id}', 'ArticleController@update')->name('articles.update');
            Route::post('articles/{id}/archive', 'ArticleController@archive')->name('articles.archive');
            Route::post('articles/{id}/restore', 'ArticleController@restore')->name('articles.restore');
            Route::post('articles/{id}/remove-image', 'ArticleController@removeImage')->name('articles.remove-image');

            Route::post('articles/fetch', 'ArticleFetchController@fetch')->name('articles.fetch');
            Route::post('articles/fetch?archived=1', 'ArticleFetchController@fetch')->name('articles.fetch-archive');
            Route::post('articles/fetch-item/{id?}', 'ArticleFetchController@fetchView')->name('articles.fetch-item');
            Route::post('articles/fetch-pagination/{id}', 'ArticleFetchController@fetchPagePagination')->name('articles.fetch-pagination');
        });

        Route::namespace('Samples')->group(function() {
            Route::get('sample-items', 'SampleItemController@index')->name('sample-items.index');
            Route::get('sample-items/create', 'SampleItemController@create')->name('sample-items.create');
            Route::post('sample-items/store', 'SampleItemController@store')->name('sample-items.store');
            Route::get('sample-items/show/{id}', 'SampleItemController@show')->name('sample-items.show');
            Route::post('sample-items/update/{id}', 'SampleItemController@update')->name('sample-items.update');
            Route::post('sample-items/{id}/archive', 'SampleItemController@archive')->name('sample-items.archive');
            Route::post('sample-items/{id}/restore', 'SampleItemController@restore')->name('sample-items.restore');
            Route::post('sample-items/{id}/remove-image', 'SampleItemController@removeImage')->name('sample-items.remove-image');

            Route::post('sample-items/export', 'SampleItemController@export')->name('sample-items.export');

            Route::post('sample-items/{id}/approve', 'SampleItemController@approve')->name('sample-items.approve');
            Route::post('sample-items/{id}/deny', 'SampleItemController@deny')->name('sample-items.deny');

            Route::post('sample-items/fetch', 'SampleItemFetchController@fetch')->name('sample-items.fetch');
            Route::post('sample-items/fetch?archived=1', 'SampleItemFetchController@fetch')->name('sample-items.fetch-archive');
            Route::post('sample-items/fetch-item/{id?}', 'SampleItemFetchController@fetchView')->name('sample-items.fetch-item');
            Route::post('sample-items/fetch-pagination/{id}', 'SampleItemFetchController@fetchPagePagination')->name('sample-items.fetch-pagination');
        });

        Route::namespace('Faqs')->group(function() {
            Route::get('faqs', 'FaqController@index')->name('faqs.index');
            Route::get('faqs/create', 'FaqController@create')->name('faqs.create');
            Route::post('faqs/store', 'FaqController@store')->name('faqs.store');
            Route::get('faqs/show/{id}', 'FaqController@show')->name('faqs.show');
            Route::post('faqs/update/{id}', 'FaqController@update')->name('faqs.update');
            Route::post('faqs/{id}/archive', 'FaqController@archive')->name('faqs.archive');
            Route::post('faqs/{id}/restore', 'FaqController@restore')->name('faqs.restore');
        
            Route::post('faqs/fetch', 'FaqFetchController@fetch')->name('faqs.fetch');
            Route::post('faqs/fetch?archived=1', 'FaqFetchController@fetch')->name('faqs.fetch-archive');
            Route::post('faqs/fetch-item/{id?}', 'FaqFetchController@fetchView')->name('faqs.fetch-item');
            Route::post('faqs/fetch-pagination/{id}', 'FaqFetchController@fetchPagePagination')->name('faqs.fetch-pagination');
        });

         /**
         * Carousels
         */
        Route::namespace('Carousels')->group(function() {
            Route::get('home-banners', 'HomeBannerController@index')->name('home-banners.index');
            Route::get('home-banners/create', 'HomeBannerController@create')->name('home-banners.create');
            Route::post('home-banners/store', 'HomeBannerController@store')->name('home-banners.store');
            Route::get('home-banners/show/{id}', 'HomeBannerController@show')->name('home-banners.show');
            Route::post('home-banners/update/{id}', 'HomeBannerController@update')->name('home-banners.update');
            Route::post('home-banners/{id}/archive', 'HomeBannerController@archive')->name('home-banners.archive');
            Route::post('home-banners/{id}/restore', 'HomeBannerController@restore')->name('home-banners.restore');
            Route::post('home-banners/{id}/remove-image', 'HomeBannerController@removeImage')->name('home-banners.remove-image');

            Route::post('home-banners/fetch', 'HomeBannerFetchController@fetch')->name('home-banners.fetch');
            Route::post('home-banners/fetch?archived=1', 'HomeBannerFetchController@fetch')->name('home-banners.fetch-archive');
            Route::post('home-banners/fetch-item/{id?}', 'HomeBannerFetchController@fetchView')->name('home-banners.fetch-item');
            Route::post('home-banners/fetch-pagination/{id}', 'HomeBannerFetchController@fetchPagePagination')->name('home-banners.fetch-pagination');
        });

        /**
        * Add-Ons
        */
        Route::namespace('AddOns')->group(function() {
            Route::get('add-ons', 'AddOnController@index')->name('add-ons.index');
            Route::get('add-ons/create', 'AddOnController@create')->name('add-ons.create');
            Route::post('add-ons/store', 'AddOnController@store')->name('add-ons.store');
            Route::get('add-ons/show/{id}', 'AddOnController@show')->name('add-ons.show');
            Route::post('add-ons/update/{id}', 'AddOnController@update')->name('add-ons.update');
            Route::post('add-ons/{id}/archive', 'AddOnController@archive')->name('add-ons.archive');
            Route::post('add-ons/{id}/restore', 'AddOnController@restore')->name('add-ons.restore');
        
            Route::post('add-ons/fetch', 'AddOnFetchController@fetch')->name('add-ons.fetch');
            Route::post('add-ons/fetch?archived=1', 'AddOnFetchController@fetch')->name('add-ons.fetch-archive');
            Route::post('add-ons/fetch-item/{id?}', 'AddOnFetchController@fetchView')->name('add-ons.fetch-item');
            Route::post('add-ons/fetch-pagination/{id}', 'AddOnFetchController@fetchPagePagination')->name('add-ons.fetch-pagination');
        });

        /**
    * Experience Information
        */
        Route::namespace('ExperienceInformation')->group(function() {
            Route::get('experience-information', 'ExperienceInformationController@index')->name('experience-information.index');
            Route::get('experience-information/create', 'ExperienceInformationController@create')->name('experience-information.create');
            Route::post('experience-information/store', 'ExperienceInformationController@store')->name('experience-information.store');
            Route::get('experience-information/show/{id}', 'ExperienceInformationController@show')->name('experience-information.show');
            Route::post('experience-information/update/{id}', 'ExperienceInformationController@update')->name('experience-information.update');
            Route::post('experience-information/{id}/archive', 'ExperienceInformationController@archive')->name('experience-information.archive');
            Route::post('experience-information/{id}/restore', 'ExperienceInformationController@restore')->name('experience-information.restore');
            Route::post('experience-information/{id}/remove-image', 'ExperienceInformationController@removeImage')->name('experience-information.remove-image');
            
        
            Route::post('experience-information/fetch', 'ExperienceInformationFetchController@fetch')->name('experience-information.fetch');
            Route::post('experience-information/fetch?archived=1', 'ExperienceInformationFetchController@fetch')->name('experience-information.fetch-archive');
            Route::post('experience-information/fetch-item/{id?}', 'ExperienceInformationFetchController@fetchView')->name('experience-information.fetch-item');
            Route::post('experience-information/fetch-pagination/{id}', 'ExperienceInformationFetchController@fetchPagePagination')->name('experience-information.fetch-pagination');
        });        

        /**
    * Experiences
        */
        Route::namespace('Experiences')->group(function() {
            Route::get('experiences', 'ExperienceController@index')->name('experiences.index');
            Route::get('experiences/create', 'ExperienceController@create')->name('experiences.create');
            Route::post('experiences/store', 'ExperienceController@store')->name('experiences.store');
            Route::get('experiences/show/{id}', 'ExperienceController@show')->name('experiences.show');
            Route::post('experiences/update/{id}', 'ExperienceController@update')->name('experiences.update');
            Route::post('experiences/{id}/archive', 'ExperienceController@archive')->name('experiences.archive');
            Route::post('experiences/{id}/restore', 'ExperienceController@restore')->name('experiences.restore');
        
            Route::post('experiences/fetch', 'ExperienceFetchController@fetch')->name('experiences.fetch');
            Route::post('experiences/fetch?archived=1', 'ExperienceFetchController@fetch')->name('experiences.fetch-archive');
            Route::post('experiences/fetch-item/{id?}', 'ExperienceFetchController@fetchView')->name('experiences.fetch-item');
            Route::post('experiences/fetch-pagination/{id}', 'ExperienceFetchController@fetchPagePagination')->name('experiences.fetch-pagination');
        });

        /**
        * Trails
        */
        Route::namespace('Trails')->group(function() {
            Route::get('trails', 'TrailController@index')->name('trails.index');
            Route::get('trails/create', 'TrailController@create')->name('trails.create');
            Route::post('trails/store', 'TrailController@store')->name('trails.store');
            Route::get('trails/show/{id}', 'TrailController@show')->name('trails.show');
            Route::post('trails/update/{id}', 'TrailController@update')->name('trails.update');
            Route::post('trails/{id}/archive', 'TrailController@archive')->name('trails.archive');
            Route::post('trails/{id}/restore', 'TrailController@restore')->name('trails.restore');
        
            Route::post('trails/fetch', 'TrailFetchController@fetch')->name('trails.fetch');
            Route::post('trails/fetch?archived=1', 'TrailFetchController@fetch')->name('trails.fetch-archive');
            Route::post('trails/fetch-item/{id?}', 'TrailFetchController@fetchView')->name('trails.fetch-item');
            Route::post('trails/fetch-pagination/{id}', 'TrailFetchController@fetchPagePagination')->name('trails.fetch-pagination');

            /* Timeslot Routes */
            Route::get('trails/show-time-slots/{id}', 'TrailController@showTimeSlots')->name('trails.show-time-slots');
        });

         /**
         * News
         */
        Route::namespace('News')->group(function() {
            Route::get('news', 'NewsController@index')->name('news.index');
            Route::get('news/create', 'NewsController@create')->name('news.create');
            Route::post('news/store', 'NewsController@store')->name('news.store');
            Route::get('news/show/{id}', 'NewsController@show')->name('news.show');
            Route::post('news/update/{id}', 'NewsController@update')->name('news.update');
            Route::post('news/{id}/archive', 'NewsController@archive')->name('news.archive');
            Route::post('news/{id}/restore', 'NewsController@restore')->name('news.restore');
            Route::post('news/{id}/remove-image', 'NewsController@removeImage')->name('news.remove-image');

            Route::post('news/fetch', 'NewsFetchController@fetch')->name('news.fetch');
            Route::post('news/fetch?archived=1', 'NewsFetchController@fetch')->name('news.fetch-archive');
            Route::post('news/fetch-item/{id?}', 'NewsFetchController@fetchView')->name('news.fetch-item');
            Route::post('news/fetch-pagination/{id}', 'NewsFetchController@fetchPagePagination')->name('news.fetch-pagination');

        });

        /**
        * TimeSlot
        */
        Route::namespace('TimeSlots')->group(function() {
            Route::get('time-slots', 'TimeSlotController@index')->name('time-slots.index');
            Route::get('time-slots/create/', 'TimeSlotController@create')->name('time-slots.create');
            Route::post('time-slots/store/', 'TimeSlotController@store')->name('time-slots.store');
            Route::get('time-slots/show/{id}', 'TimeSlotController@show')->name('time-slots.show');
            Route::post('time-slots/update/{id}', 'TimeSlotController@update')->name('time-slots.update');
            Route::post('time-slots/{id}/archive', 'TimeSlotController@archive')->name('time-slots.archive');
            Route::post('time-slots/{id}/restore', 'TimeSlotController@restore')->name('time-slots.restore');
            Route::post('time-slots/reorder', 'TimeSlotController@reOrder')->name('time-slots.reorder');
        
            Route::post('time-slots/fetch', 'TimeSlotFetchController@fetch')->name('time-slots.fetch');
            Route::post('time-slots/fetch?trail={id?}', 'TimeSlotFetchController@fetch')->name('time-slots.fetch-filtered');
            Route::post('time-slots/fetch?archived=1', 'TimeSlotFetchController@fetch')->name('time-slots.fetch-archive');
            Route::post('time-slots/fetch-item/{id?}', 'TimeSlotFetchController@fetchView')->name('time-slots.fetch-item');
            Route::post('time-slots/fetch-pagination/{id}', 'TimeSlotFetchController@fetchPagePagination')->name('time-slots.fetch-pagination');
        });
        
        /**
        * BlockedDateTime
        */
        Route::namespace('BlockedDateTime')->group(function() {
            Route::get('blocked-dates', 'BlockedDateTimeController@index')->name('blocked-dates.index');
            Route::get('blocked-dates/create', 'BlockedDateTimeController@create')->name('blocked-dates.create');
            Route::post('blocked-dates/store', 'BlockedDateTimeController@store')->name('blocked-dates.store');
            Route::get('blocked-dates/show/{id}', 'BlockedDateTimeController@show')->name('blocked-dates.show');
            Route::post('blocked-dates/update/{id}', 'BlockedDateTimeController@update')->name('blocked-dates.update');
            Route::post('blocked-dates/{id}/archive', 'BlockedDateTimeController@archive')->name('blocked-dates.archive');
            Route::post('blocked-dates/{id}/restore', 'BlockedDateTimeController@restore')->name('blocked-dates.restore');
        
            Route::post('blocked-dates/fetch', 'BlockedDateTimeFetchController@fetch')->name('blocked-dates.fetch');
            Route::post('blocked-dates/fetch/?trail={id?}/time', 'BlockedDateTimeFetchController@fetch')->name('blocked-dates.fetch.time');
            Route::post('blocked-dates/fetch?archived=1', 'BlockedDateTimeFetchController@fetch')->name('blocked-dates.fetch-archive');
            Route::post('blocked-dates/fetch-item/{id?}', 'BlockedDateTimeFetchController@fetchView')->name('blocked-dates.fetch-item');
            Route::post('blocked-dates/fetch-pagination/{id}', 'BlockedDateTimeFetchController@fetchPagePagination')->name('blocked-dates.fetch-pagination');
        });
        /**
        * Capacities
        */
        Route::namespace('Capacities')->group(function() {
            Route::get('capacities', 'CapacityController@index')->name('capacities.index');
            Route::get('capacities/create', 'CapacityController@create')->name('capacities.create');
            Route::post('capacities/store', 'CapacityController@store')->name('capacities.store');
            Route::get('capacities/show/{id}', 'CapacityController@show')->name('capacities.show');
            Route::post('capacities/update/{id}', 'CapacityController@update')->name('capacities.update');
            Route::post('capacities/{id}/archive', 'CapacityController@archive')->name('capacities.archive');
            Route::post('capacities/{id}/restore', 'CapacityController@restore')->name('capacities.restore');
        
            Route::post('capacities/fetch', 'CapacityFetchController@fetch')->name('capacities.fetch');
            Route::post('capacities/fetch/?trail={id?}/time', 'CapacityFetchController@fetch')->name('capacities.fetch.time');
            Route::post('capacities/fetch?archived=1', 'CapacityFetchController@fetch')->name('capacities.fetch-archive');
            Route::post('capacities/fetch-item/{id?}', 'CapacityFetchController@fetchView')->name('capacities.fetch-item');
            Route::post('capacities/fetch-pagination/{id}', 'CapacityFetchController@fetchPagePagination')->name('capacities.fetch-pagination');
        });
        /**
        * Awards
        */
        Route::namespace('Awards')->group(function() {
            Route::get('awards', 'AwardController@index')->name('awards.index');
            Route::get('awards/create', 'AwardController@create')->name('awards.create');
            Route::post('awards/store', 'AwardController@store')->name('awards.store');
            Route::get('awards/show/{id}', 'AwardController@show')->name('awards.show');
            Route::post('awards/update/{id}', 'AwardController@update')->name('awards.update');
            Route::post('awards/{id}/archive', 'AwardController@archive')->name('awards.archive');
            Route::post('awards/{id}/restore', 'AwardController@restore')->name('awards.restore');
            Route::post('awards/{id}/remove-image', 'AwardController@removeImage')->name('awards.remove-image');

        
            Route::post('awards/fetch', 'AwardFetchController@fetch')->name('awards.fetch');
            Route::post('awards/fetch/?trail={id?}/time', 'AwardFetchController@fetch')->name('awards.fetch.time');
            Route::post('awards/fetch?archived=1', 'AwardFetchController@fetch')->name('awards.fetch-archive');
            Route::post('awards/fetch-item/{id?}', 'AwardFetchController@fetchView')->name('awards.fetch-item');
            Route::post('awards/fetch-pagination/{id}', 'AwardFetchController@fetchPagePagination')->name('awards.fetch-pagination');
        });

        /**
        * Features
        */
        Route::namespace('Features')->group(function() {
            Route::get('features', 'FeatureController@index')->name('features.index');
            Route::get('features/create', 'FeatureController@create')->name('features.create');
            Route::post('features/store', 'FeatureController@store')->name('features.store');
            Route::get('features/show/{id}', 'FeatureController@show')->name('features.show');
            Route::post('features/update/{id}', 'FeatureController@update')->name('features.update');
            Route::post('features/{id}/archive', 'FeatureController@archive')->name('features.archive');
            Route::post('features/{id}/restore', 'FeatureController@restore')->name('features.restore');
            Route::post('features/{id}/remove-image', 'FeatureController@removeImage')->name('features.remove-image');

        
            Route::post('features/fetch', 'FeatureFetchController@fetch')->name('features.fetch');
            Route::post('features/fetch/?trail={id?}/time', 'FeatureFetchController@fetch')->name('features.fetch.time');
            Route::post('features/fetch?archived=1', 'FeatureFetchController@fetch')->name('features.fetch-archive');
            Route::post('features/fetch-item/{id?}', 'FeatureFetchController@fetchView')->name('features.fetch-item');
            Route::post('features/fetch-pagination/{id}', 'FeatureFetchController@fetchPagePagination')->name('features.fetch-pagination');
        });

        /**
        * Beyond Masungi
        */
        Route::namespace('BeyondMasungi')->group(function() {
            Route::get('beyondmasungi', 'BeyondMasungiController@index')->name('beyondmasungi.index');
            Route::get('beyondmasungi/create', 'BeyondMasungiController@create')->name('beyondmasungi.create');
            Route::post('beyondmasungi/store', 'BeyondMasungiController@store')->name('beyondmasungi.store');
            Route::get('beyondmasungi/show/{id}', 'BeyondMasungiController@show')->name('beyondmasungi.show');
            Route::post('beyondmasungi/update/{id}', 'BeyondMasungiController@update')->name('beyondmasungi.update');
            Route::post('beyondmasungi/{id}/archive', 'BeyondMasungiController@archive')->name('beyondmasungi.archive');
            Route::post('beyondmasungi/{id}/restore', 'BeyondMasungiController@restore')->name('beyondmasungi.restore');
            Route::post('beyondmasungi/{id}/remove-image', 'BeyondMasungiController@removeImage')->name('beyondmasungi.remove-image');

        
            Route::post('beyondmasungi/fetch', 'BeyondMasungiFetchController@fetch')->name('beyondmasungi.fetch');
            Route::post('beyondmasungi/fetch/?trail={id?}/time', 'BeyondMasungiFetchController@fetch')->name('beyondmasungi.fetch.time');
            Route::post('beyondmasungi/fetch?archived=1', 'BeyondMasungiFetchController@fetch')->name('beyondmasungi.fetch-archive');
            Route::post('beyondmasungi/fetch-item/{id?}', 'BeyondMasungiFetchController@fetchView')->name('beyondmasungi.fetch-item');
            Route::post('beyondmasungi/fetch-pagination/{id}', 'BeyondMasungiFetchController@fetchPagePagination')->name('beyondmasungi.fetch-pagination');
        });

        /**
        * Desination Carousel
        */
        Route::namespace('DestinationCarousel')->group(function() {
            Route::get('destinationcarousel', 'DestinationCarouselController@index')->name('destinationcarousel.index');
            Route::get('destinationcarousel/create', 'DestinationCarouselController@create')->name('destinationcarousel.create');
            Route::post('destinationcarousel/store', 'DestinationCarouselController@store')->name('destinationcarousel.store');
            Route::get('destinationcarousel/show/{id}', 'DestinationCarouselController@show')->name('destinationcarousel.show');
            Route::post('destinationcarousel/update/{id}', 'DestinationCarouselController@update')->name('destinationcarousel.update');
            Route::post('destinationcarousel/{id}/archive', 'DestinationCarouselController@archive')->name('destinationcarousel.archive');
            Route::post('destinationcarousel/{id}/restore', 'DestinationCarouselController@restore')->name('destinationcarousel.restore');
            Route::post('destinationcarousel/{id}/remove-image', 'DestinationCarouselController@removeImage')->name('destinationcarousel.remove-image');

        
            Route::post('destinationcarousel/fetch', 'DestinationCarouselFetchController@fetch')->name('destinationcarousel.fetch');
            Route::post('destinationcarousel/fetch/?trail={id?}/time', 'DestinationCarouselFetchController@fetch')->name('destinationcarousel.fetch.time');
            Route::post('destinationcarousel/fetch?archived=1', 'DestinationCarouselFetchController@fetch')->name('destinationcarousel.fetch-archive');
            Route::post('destinationcarousel/fetch-item/{id?}', 'DestinationCarouselFetchController@fetchView')->name('destinationcarousel.fetch-item');
            Route::post('destinationcarousel/fetch-pagination/{id}', 'DestinationCarouselFetchController@fetchPagePagination')->name('destinationcarousel.fetch-pagination');
        });

        /**
        * Previous Guests
        */
        Route::namespace('PreviousGuests')->group(function() {
            Route::get('previousguests', 'PreviousGuestController@index')->name('previousguests.index');
            Route::get('previousguests/create', 'PreviousGuestController@create')->name('previousguests.create');
            Route::post('previousguests/store', 'PreviousGuestController@store')->name('previousguests.store');
            Route::get('previousguests/show/{id}', 'PreviousGuestController@show')->name('previousguests.show');
            Route::post('previousguests/update/{id}', 'PreviousGuestController@update')->name('previousguests.update');
            Route::post('previousguests/{id}/archive', 'PreviousGuestController@archive')->name('previousguests.archive');
            Route::post('previousguests/{id}/restore', 'PreviousGuestController@restore')->name('previousguests.restore');
            Route::post('previousguests/{id}/remove-image', 'PreviousGuestController@removeImage')->name('previousguests.remove-image');

        
            Route::post('previousguests/fetch', 'PreviousGuestFetchController@fetch')->name('previousguests.fetch');
            Route::post('previousguests/fetch/?trail={id?}/time', 'PreviousGuestFetchController@fetch')->name('previousguests.fetch.time');
            Route::post('previousguests/fetch?archived=1', 'PreviousGuestFetchController@fetch')->name('previousguests.fetch-archive');
            Route::post('previousguests/fetch-item/{id?}', 'PreviousGuestFetchController@fetchView')->name('previousguests.fetch-item');
            Route::post('previousguests/fetch-pagination/{id}', 'PreviousGuestFetchController@fetchPagePagination')->name('previousguests.fetch-pagination');
        });

        /**
        * Collaborators
        */
        Route::namespace('Collaborators')->group(function() {
            Route::get('collaborators', 'CollaboratorController@index')->name('collaborators.index');
            Route::get('collaborators/create', 'CollaboratorController@create')->name('collaborators.create');
            Route::post('collaborators/store', 'CollaboratorController@store')->name('collaborators.store');
            Route::get('collaborators/show/{id}', 'CollaboratorController@show')->name('collaborators.show');
            Route::post('collaborators/update/{id}', 'CollaboratorController@update')->name('collaborators.update');
            Route::post('collaborators/{id}/archive', 'CollaboratorController@archive')->name('collaborators.archive');
            Route::post('collaborators/{id}/restore', 'CollaboratorController@restore')->name('collaborators.restore');
            Route::post('collaborators/{id}/remove-image', 'CollaboratorController@removeImage')->name('collaborators.remove-image');

        
            Route::post('collaborators/fetch', 'CollaboratorFetchController@fetch')->name('collaborators.fetch');
            Route::post('collaborators/fetch/?trail={id?}/time', 'CollaboratorFetchController@fetch')->name('collaborators.fetch.time');
            Route::post('collaborators/fetch?archived=1', 'CollaboratorFetchController@fetch')->name('collaborators.fetch-archive');
            Route::post('collaborators/fetch-item/{id?}', 'CollaboratorFetchController@fetchView')->name('collaborators.fetch-item');
            Route::post('collaborators/fetch-pagination/{id}', 'CollaboratorFetchController@fetchPagePagination')->name('collaborators.fetch-pagination');
        });

        /**
        * Researches
        */
        Route::namespace('Researches')->group(function() {
            Route::get('researches', 'ResearchController@index')->name('researches.index');
            Route::get('researches/create', 'ResearchController@create')->name('researches.create');
            Route::post('researches/store', 'ResearchController@store')->name('researches.store');
            Route::get('researches/show/{id}', 'ResearchController@show')->name('researches.show');
            Route::post('researches/update/{id}', 'ResearchController@update')->name('researches.update');
            Route::post('researches/{id}/archive', 'ResearchController@archive')->name('researches.archive');
            Route::post('researches/{id}/restore', 'ResearchController@restore')->name('researches.restore');
            Route::post('researches/{id}/remove-image', 'ResearchController@removeImage')->name('researches.remove-image');

        
            Route::post('researches/fetch', 'ResearchFetchController@fetch')->name('researches.fetch');
            Route::post('researches/fetch/?trail={id?}/time', 'ResearchFetchController@fetch')->name('researches.fetch.time');
            Route::post('researches/fetch?archived=1', 'ResearchFetchController@fetch')->name('researches.fetch-archive');
            Route::post('researches/fetch-item/{id?}', 'ResearchFetchController@fetchView')->name('researches.fetch-item');
            Route::post('researches/fetch-pagination/{id}', 'ResearchFetchController@fetchPagePagination')->name('researches.fetch-pagination');
        });
        /**
        * Information Kits
        */
        Route::namespace('InformationKits')->group(function() {
            Route::get('informationkits', 'InformationKitController@index')->name('informationkits.index');
            Route::get('informationkits/create', 'InformationKitController@create')->name('informationkits.create');
            Route::post('informationkits/store', 'InformationKitController@store')->name('informationkits.store');
            Route::get('informationkits/show/{id}', 'InformationKitController@show')->name('informationkits.show');
            Route::post('informationkits/update/{id}', 'InformationKitController@update')->name('informationkits.update');
            Route::post('informationkits/{id}/archive', 'InformationKitController@archive')->name('informationkits.archive');
            Route::post('informationkits/{id}/restore', 'InformationKitController@restore')->name('informationkits.restore');
            Route::post('informationkits/{id}/remove-image', 'InformationKitController@removeImage')->name('informationkits.remove-image');

        
            Route::post('informationkits/fetch', 'InformationKitFetchController@fetch')->name('informationkits.fetch');
            Route::post('informationkits/fetch/?trail={id?}/time', 'InformationKitFetchController@fetch')->name('informationkits.fetch.time');
            Route::post('informationkits/fetch?archived=1', 'InformationKitFetchController@fetch')->name('informationkits.fetch-archive');
            Route::post('informationkits/fetch-item/{id?}', 'InformationKitFetchController@fetchView')->name('informationkits.fetch-item');
            Route::post('informationkits/fetch-pagination/{id}', 'InformationKitFetchController@fetchPagePagination')->name('informationkits.fetch-pagination');
        });                
        /**
        * Gallery
        */
        Route::namespace('Galleries')->group(function() {
            Route::get('galleries', 'GalleryController@index')->name('galleries.index');
            Route::get('galleries/create', 'GalleryController@create')->name('galleries.create');
            Route::post('galleries/store', 'GalleryController@store')->name('galleries.store');
            Route::get('galleries/show/{id}', 'GalleryController@show')->name('galleries.show');
            Route::post('galleries/update/{id}', 'GalleryController@update')->name('galleries.update');
            Route::post('galleries/{id}/archive', 'GalleryController@archive')->name('galleries.archive');
            Route::post('galleries/{id}/restore', 'GalleryController@restore')->name('galleries.restore');
            Route::post('galleries/{id}/remove-image', 'GalleryController@removeImage')->name('galleries.remove-image');

        
            Route::post('galleries/fetch', 'GalleryFetchController@fetch')->name('galleries.fetch');
            Route::post('galleries/fetch/?trail={id?}/time', 'GalleryFetchController@fetch')->name('galleries.fetch.time');
            Route::post('galleries/fetch?archived=1', 'GalleryFetchController@fetch')->name('galleries.fetch-archive');
            Route::post('galleries/fetch-item/{id?}', 'GalleryFetchController@fetchView')->name('galleries.fetch-item');
            Route::post('galleries/fetch-pagination/{id}', 'GalleryFetchController@fetchPagePagination')->name('galleries.fetch-pagination');
        });                        
        /**
        * Trail Stops
        */
        Route::namespace('TrailStops')->group(function() {
            Route::get('trailstops', 'TrailStopController@index')->name('trailstops.index');
            Route::get('trailstops/create', 'TrailStopController@create')->name('trailstops.create');
            Route::post('trailstops/store', 'TrailStopController@store')->name('trailstops.store');            
            // Route::get('trailstops/create/{id}/{name}', 'TrailStopController@create')->name('trailstops.create');
            Route::post('trailstops/store', 'TrailStopController@store')->name('trailstops.store');
            Route::get('trailstops/show/{id}', 'TrailStopController@show')->name('trailstops.show');
            Route::post('trailstops/update/{id}', 'TrailStopController@update')->name('trailstops.update');
            Route::post('trailstops/{id}/archive', 'TrailStopController@archive')->name('trailstops.archive');
            Route::post('trailstops/{id}/restore', 'TrailStopController@restore')->name('trailstops.restore');
            Route::post('trailstops/{id}/remove-image', 'TrailStopController@removeImage')->name('trailstops.remove-image');

        
            Route::post('trailstops/fetch', 'TrailStopFetchController@fetch')->name('trailstops.fetch');
            Route::post('trailstops/fetch/?trail={id?}/time', 'TrailStopFetchController@fetch')->name('trailstops.fetch.time');
            Route::post('trailstops/fetch?archived=1', 'TrailStopFetchController@fetch')->name('trailstops.fetch-archive');
            Route::post('trailstops/fetch-item/{id?}', 'TrailStopFetchController@fetchView')->name('trailstops.fetch-item');
            Route::post('trailstops/fetch-pagination/{id}', 'TrailStopFetchController@fetchPagePagination')->name('trailstops.fetch-pagination');
        });

        /**
        * WeddingVenues
        */
        Route::namespace('WeddingVenues')->group(function() {
            Route::get('weddingvenues', 'WeddingVenueController@index')->name('weddingvenues.index');
            Route::get('weddingvenues/create', 'WeddingVenueController@create')->name('weddingvenues.create');
            Route::post('weddingvenues/store', 'WeddingVenueController@store')->name('weddingvenues.store');
            Route::get('weddingvenues/show/{id}', 'WeddingVenueController@show')->name('weddingvenues.show');
            Route::post('weddingvenues/update/{id}', 'WeddingVenueController@update')->name('weddingvenues.update');
            Route::post('weddingvenues/{id}/archive', 'WeddingVenueController@archive')->name('weddingvenues.archive');
            Route::post('weddingvenues/{id}/restore', 'WeddingVenueController@restore')->name('weddingvenues.restore');
            Route::post('weddingvenues/{id}/remove-image', 'WeddingVenueController@removeImage')->name('weddingvenues.remove-image');

        
            Route::post('weddingvenues/fetch', 'WeddingVenueFetchController@fetch')->name('weddingvenues.fetch');
            Route::post('weddingvenues/fetch/?trail={id?}/time', 'WeddingVenueFetchController@fetch')->name('weddingvenues.fetch.time');
            Route::post('weddingvenues/fetch?archived=1', 'WeddingVenueFetchController@fetch')->name('weddingvenues.fetch-archive');
            Route::post('weddingvenues/fetch-item/{id?}', 'WeddingVenueFetchController@fetchView')->name('weddingvenues.fetch-item');
            Route::post('weddingvenues/fetch-pagination/{id}', 'WeddingVenueFetchController@fetchPagePagination')->name('weddingvenues.fetch-pagination');
        });                        

        /**
        * WeddingBoards
        */
        Route::namespace('WeddingBoards')->group(function() {
            Route::get('weddingboards', 'WeddingBoardController@index')->name('weddingboards.index');
            Route::get('weddingboards/create', 'WeddingBoardController@create')->name('weddingboards.create');
            Route::post('weddingboards/store', 'WeddingBoardController@store')->name('weddingboards.store');
            Route::get('weddingboards/show/{id}', 'WeddingBoardController@show')->name('weddingboards.show');
            Route::post('weddingboards/update/{id}', 'WeddingBoardController@update')->name('weddingboards.update');
            Route::post('weddingboards/{id}/archive', 'WeddingBoardController@archive')->name('weddingboards.archive');
            Route::post('weddingboards/{id}/restore', 'WeddingBoardController@restore')->name('weddingboards.restore');
            Route::post('weddingboards/{id}/remove-image', 'WeddingBoardController@removeImage')->name('weddingboards.remove-image');

        
            Route::post('weddingboards/fetch', 'WeddingBoardFetchController@fetch')->name('weddingboards.fetch');
            Route::post('weddingboards/fetch/?trail={id?}/time', 'WeddingBoardFetchController@fetch')->name('weddingboards.fetch.time');
            Route::post('weddingboards/fetch?archived=1', 'WeddingBoardFetchController@fetch')->name('weddingboards.fetch-archive');
            Route::post('weddingboards/fetch-item/{id?}', 'WeddingBoardFetchController@fetchView')->name('weddingboards.fetch-item');
            Route::post('weddingboards/fetch-pagination/{id}', 'WeddingBoardFetchController@fetchPagePagination')->name('weddingboards.fetch-pagination');
        });                     

        /**
        * Events
        */
        Route::namespace('Events')->group(function() {
            Route::get('events', 'EventController@index')->name('events.index');
            Route::get('events/create', 'EventController@create')->name('events.create');
            Route::post('events/store', 'EventController@store')->name('events.store');
            Route::get('events/show/{id}', 'EventController@show')->name('events.show');
            Route::post('events/update/{id}', 'EventController@update')->name('events.update');
            Route::post('events/{id}/archive', 'EventController@archive')->name('events.archive');
            Route::post('events/{id}/restore', 'EventController@restore')->name('events.restore');
        
            Route::post('events/fetch', 'EventFetchController@fetch')->name('events.fetch');
            Route::post('events/fetch?archived=1', 'EventFetchController@fetch')->name('events.fetch-archive');
            Route::post('events/fetch-item/{id?}', 'EventFetchController@fetchView')->name('events.fetch-item');
            Route::post('events/fetch-pagination/{id}', 'EventFetchController@fetchPagePagination')->name('events.fetch-pagination');
        });                   

        /**
        * Events Types
        */
        Route::namespace('EventTypes')->group(function() {
            Route::get('eventtypes', 'EventTypeController@index')->name('eventtypes.index');
            Route::get('eventtypes/create', 'EventTypeController@create')->name('eventtypes.create');
            Route::post('eventtypes/store', 'EventTypeController@store')->name('eventtypes.store');
            Route::get('eventtypes/show/{id}', 'EventTypeController@show')->name('eventtypes.show');
            Route::post('eventtypes/update/{id}', 'EventTypeController@update')->name('eventtypes.update');
            Route::post('eventtypes/{id}/archive', 'EventTypeController@archive')->name('eventtypes.archive');
            Route::post('eventtypes/{id}/restore', 'EventTypeController@restore')->name('eventtypes.restore');
        
            Route::post('eventtypes/fetch', 'EventTypeFetchController@fetch')->name('eventtypes.fetch');
            Route::post('eventtypes/fetch?archived=1', 'EventTypeFetchController@fetch')->name('eventtypes.fetch-archive');
            Route::post('eventtypes/fetch-item/{id?}', 'EventTypeFetchController@fetchView')->name('eventtypes.fetch-item');
            Route::post('eventtypes/fetch-pagination/{id}', 'EventTypeFetchController@fetchPagePagination')->name('eventtypes.fetch-pagination');
        });                   
        
        /**
        * Events Information
        */
        Route::namespace('EventInformations')->group(function() {
            Route::get('eventinformations', 'EventInformationController@index')->name('eventinformations.index');
            Route::get('eventinformations/create', 'EventInformationController@create')->name('eventinformations.create');
            Route::post('eventinformations/store', 'EventInformationController@store')->name('eventinformations.store');
            Route::get('eventinformations/show/{id}', 'EventInformationController@show')->name('eventinformations.show');
            Route::post('eventinformations/update/{id}', 'EventInformationController@update')->name('eventinformations.update');
            Route::post('eventinformations/{id}/archive', 'EventInformationController@archive')->name('eventinformations.archive');
            Route::post('eventinformations/{id}/restore', 'EventInformationController@restore')->name('eventinformations.restore');
            Route::post('eventinformations/{id}/remove-image', 'EventInformationController@removeImage')->name('eventinformations.remove-image');

        
            Route::post('eventinformations/fetch', 'EventInformationFetchController@fetch')->name('eventinformations.fetch');
            Route::post('eventinformations/fetch?archived=1', 'EventInformationFetchController@fetch')->name('eventinformations.fetch-archive');
            Route::post('eventinformations/fetch-item/{id?}', 'EventInformationFetchController@fetchView')->name('eventinformations.fetch-item');
            Route::post('eventinformations/fetch-pagination/{id}', 'EventInformationFetchController@fetchPagePagination')->name('eventinformations.fetch-pagination');
        }); 


        /**
        * Event Carousel
        */
        Route::namespace('EventCarousels')->group(function() {
            Route::get('eventcarousels', 'EventCarouselController@index')->name('eventcarousels.index');
            Route::get('eventcarousels/create', 'EventCarouselController@create')->name('eventcarousels.create');
            Route::post('eventcarousels/store', 'EventCarouselController@store')->name('eventcarousels.store');
            Route::get('eventcarousels/show/{id}', 'EventCarouselController@show')->name('eventcarousels.show');
            Route::post('eventcarousels/update/{id}', 'EventCarouselController@update')->name('eventcarousels.update');
            Route::post('eventcarousels/{id}/archive', 'EventCarouselController@archive')->name('eventcarousels.archive');
            Route::post('eventcarousels/{id}/restore', 'EventCarouselController@restore')->name('eventcarousels.restore');
            Route::post('eventcarousels/{id}/remove-image', 'EventCarouselController@removeImage')->name('eventcarousels.remove-image');

        
            Route::post('eventcarousels/fetch', 'EventCarouselFetchController@fetch')->name('eventcarousels.fetch');
            Route::post('eventcarousels/fetch/?trail={id?}/time', 'EventCarouselFetchController@fetch')->name('eventcarousels.fetch.time');
            Route::post('eventcarousels/fetch?archived=1', 'EventCarouselFetchController@fetch')->name('eventcarousels.fetch-archive');
            Route::post('eventcarousels/fetch-item/{id?}', 'EventCarouselFetchController@fetchView')->name('eventcarousels.fetch-item');
            Route::post('eventcarousels/fetch-pagination/{id}', 'EventCarouselFetchController@fetchPagePagination')->name('eventcarousels.fetch-pagination');
        });

        /**
        * Old New Masungi Carousel
        */
        Route::namespace('OldNewCarousels')->group(function() {
            Route::get('oldnewcarousels', 'OldNewCarouselController@index')->name('oldnewcarousels.index');
            Route::get('oldnewcarousels/create', 'OldNewCarouselController@create')->name('oldnewcarousels.create');
            Route::post('oldnewcarousels/store', 'OldNewCarouselController@store')->name('oldnewcarousels.store');
            Route::get('oldnewcarousels/show/{id}', 'OldNewCarouselController@show')->name('oldnewcarousels.show');
            Route::post('oldnewcarousels/update/{id}', 'OldNewCarouselController@update')->name('oldnewcarousels.update');
            Route::post('oldnewcarousels/{id}/archive', 'OldNewCarouselController@archive')->name('oldnewcarousels.archive');
            Route::post('oldnewcarousels/{id}/restore', 'OldNewCarouselController@restore')->name('oldnewcarousels.restore');
            Route::post('oldnewcarousels/{id}/remove-image', 'OldNewCarouselController@removeImage')->name('oldnewcarousels.remove-image');

        
            Route::post('oldnewcarousels/fetch', 'OldNewCarouselFetchController@fetch')->name('oldnewcarousels.fetch');
            Route::post('oldnewcarousels/fetch/?trail={id?}/time', 'OldNewCarouselFetchController@fetch')->name('oldnewcarousels.fetch.time');
            Route::post('oldnewcarousels/fetch?archived=1', 'OldNewCarouselFetchController@fetch')->name('oldnewcarousels.fetch-archive');
            Route::post('oldnewcarousels/fetch-item/{id?}', 'OldNewCarouselFetchController@fetchView')->name('oldnewcarousels.fetch-item');
            Route::post('oldnewcarousels/fetch-pagination/{id}', 'OldNewCarouselFetchController@fetchPagePagination')->name('oldnewcarousels.fetch-pagination');
        });

       /**
        * Home Experience Carousel
        */
        Route::namespace('ExperienceCarousels')->group(function() {
            Route::get('experiencecarousels', 'ExperienceCarouselController@index')->name('experiencecarousels.index');
            Route::get('experiencecarousels/create', 'ExperienceCarouselController@create')->name('experiencecarousels.create');
            Route::post('experiencecarousels/store', 'ExperienceCarouselController@store')->name('experiencecarousels.store');
            Route::get('experiencecarousels/show/{id}', 'ExperienceCarouselController@show')->name('experiencecarousels.show');
            Route::post('experiencecarousels/update/{id}', 'ExperienceCarouselController@update')->name('experiencecarousels.update');
            Route::post('experiencecarousels/{id}/archive', 'ExperienceCarouselController@archive')->name('experiencecarousels.archive');
            Route::post('experiencecarousels/{id}/restore', 'ExperienceCarouselController@restore')->name('experiencecarousels.restore');
            Route::post('experiencecarousels/{id}/remove-image', 'ExperienceCarouselController@removeImage')->name('experiencecarousels.remove-image');

        
            Route::post('experiencecarousels/fetch', 'ExperienceCarouselFetchController@fetch')->name('experiencecarousels.fetch');
            Route::post('experiencecarousels/fetch/?trail={id?}/time', 'ExperienceCarouselFetchController@fetch')->name('experiencecarousels.fetch.time');
            Route::post('experiencecarousels/fetch?archived=1', 'ExperienceCarouselFetchController@fetch')->name('experiencecarousels.fetch-archive');
            Route::post('experiencecarousels/fetch-item/{id?}', 'ExperienceCarouselFetchController@fetchView')->name('experiencecarousels.fetch-item');
            Route::post('experiencecarousels/fetch-pagination/{id}', 'ExperienceCarouselFetchController@fetchPagePagination')->name('experiencecarousels.fetch-pagination');
        });
        

       /**
        * Inquiries
        */

       /**
        * Contact-Us
        */
        Route::namespace('ContactUs')->group(function() {
            Route::get('contactus', 'ContactUsController@index')->name('contactus.index');
            Route::get('contactus/show/{id}', 'ContactUsController@show')->name('contactus.show');
            Route::post('contactus/{id}/archive', 'ContactUsController@archive')->name('contactus.archive');
            Route::post('contactus/{id}/restore', 'ContactUsController@restore')->name('contactus.restore');

            Route::post('contactus/fetch', 'ContactUsFetchController@fetch')->name('contactus.fetch');
            Route::post('contactus/fetch?archived=1', 'ContactUsFetchController@fetch')->name('contactus.fetch-archive');
            Route::post('contactus/fetch-item/{id?}', 'ContactUsFetchController@fetchView')->name('contactus.fetch-item');
            Route::post('contactus/fetch-pagination/{id}', 'ContactUsFetchController@fetchPagePagination')->name('contactus.fetch-pagination');
        });

        /**
        * Company Event Inquiry
        */
        Route::namespace('CompanyInquiries')->group(function() {
            Route::get('companyinquiries', 'CompanyInquiryController@index')->name('companyinquiries.index');
            Route::get('companyinquiries/show/{id}', 'CompanyInquiryController@show')->name('companyinquiries.show');
            Route::post('companyinquiries/{id}/archive', 'CompanyInquiryController@archive')->name('companyinquiries.archive');
            Route::post('companyinquiries/{id}/restore', 'CompanyInquiryController@restore')->name('companyinquiries.restore');

            Route::post('companyinquiries/fetch', 'CompanyInquiryFetchController@fetch')->name('companyinquiries.fetch');
            Route::post('companyinquiries/fetch?archived=1', 'CompanyInquiryFetchController@fetch')->name('companyinquiries.fetch-archive');
            Route::post('companyinquiries/fetch-item/{id?}', 'CompanyInquiryFetchController@fetchView')->name('companyinquiries.fetch-item');
            Route::post('companyinquiries/fetch-pagination/{id}', 'CompanyInquiryFetchController@fetchPagePagination')->name('companyinquiries.fetch-pagination');
        });        

        /**
        * School Event Inquiry
        */
        Route::namespace('SchoolInquiries')->group(function() {
            Route::get('schoolinquiries', 'SchoolInquiryController@index')->name('schoolinquiries.index');
            Route::get('schoolinquiries/show/{id}', 'SchoolInquiryController@show')->name('schoolinquiries.show');
            Route::post('schoolinquiries/{id}/archive', 'SchoolInquiryController@archive')->name('schoolinquiries.archive');
            Route::post('schoolinquiries/{id}/restore', 'SchoolInquiryController@restore')->name('schoolinquiries.restore');

            Route::post('schoolinquiries/fetch', 'SchoolInquiryFetchController@fetch')->name('schoolinquiries.fetch');
            Route::post('schoolinquiries/fetch?archived=1', 'SchoolInquiryFetchController@fetch')->name('schoolinquiries.fetch-archive');
            Route::post('schoolinquiries/fetch-item/{id?}', 'SchoolInquiryFetchController@fetchView')->name('schoolinquiries.fetch-item');
            Route::post('schoolinquiries/fetch-pagination/{id}', 'SchoolInquiryFetchController@fetchPagePagination')->name('schoolinquiries.fetch-pagination');
        });        

        /**
        * Wedding Event Inquiry
        */
        Route::namespace('WeddingInquiries')->group(function() {
            Route::get('weddinginquiries', 'WeddingInquiryController@index')->name('weddinginquiries.index');
            Route::get('weddinginquiries/show/{id}', 'WeddingInquiryController@show')->name('weddinginquiries.show');
            Route::post('weddinginquiries/{id}/archive', 'WeddingInquiryController@archive')->name('weddinginquiries.archive');
            Route::post('weddinginquiries/{id}/restore', 'WeddingInquiryController@restore')->name('weddinginquiries.restore');

            Route::post('weddinginquiries/fetch', 'WeddingInquiryFetchController@fetch')->name('weddinginquiries.fetch');
            Route::post('weddinginquiries/fetch?archived=1', 'WeddingInquiryFetchController@fetch')->name('weddinginquiries.fetch-archive');
            Route::post('weddinginquiries/fetch-item/{id?}', 'WeddingInquiryFetchController@fetchView')->name('weddinginquiries.fetch-item');
            Route::post('weddinginquiries/fetch-pagination/{id}', 'WeddingInquiryFetchController@fetchPagePagination')->name('weddinginquiries.fetch-pagination');
        });   

        /**
        * Declarations
        */
        Route::namespace('Declarations')->group(function() {
            Route::get('declarations', 'DeclarationController@index')->name('declarations.index');
            Route::get('declarations/create', 'DeclarationController@create')->name('declarations.create');
            Route::post('declarations/store', 'DeclarationController@store')->name('declarations.store');
            Route::get('declarations/show/{id}', 'DeclarationController@show')->name('declarations.show');
            Route::post('declarations/update/{id}', 'DeclarationController@update')->name('declarations.update');
            Route::post('declarations/{id}/archive', 'DeclarationController@archive')->name('declarations.archive');
            Route::post('declarations/{id}/restore', 'DeclarationController@restore')->name('declarations.restore');

            Route::post('declarations/fetch', 'DeclarationFetchController@fetch')->name('declarations.fetch');
            Route::post('declarations/fetch?archived=1', 'DeclarationFetchController@fetch')->name('declarations.fetch-archive');
            Route::post('declarations/fetch-item/{id?}', 'DeclarationFetchController@fetchView')->name('declarations.fetch-item');
            Route::post('declarations/fetch-pagination/{id}', 'DeclarationFetchController@fetchPagePagination')->name('declarations.fetch-pagination');
        });        
    
        /**
        * Wedding Event Inquiry
        */
        Route::namespace('WeddingInquiries')->group(function() {
            Route::get('weddinginquiries', 'WeddingInquiryController@index')->name('weddinginquiries.index');
            Route::get('weddinginquiries/show/{id}', 'WeddingInquiryController@show')->name('weddinginquiries.show');
            Route::post('weddinginquiries/{id}/archive', 'WeddingInquiryController@archive')->name('weddinginquiries.archive');
            Route::post('weddinginquiries/{id}/restore', 'WeddingInquiryController@restore')->name('weddinginquiries.restore');

            Route::post('weddinginquiries/fetch', 'WeddingInquiryFetchController@fetch')->name('weddinginquiries.fetch');
            Route::post('weddinginquiries/fetch?archived=1', 'WeddingInquiryFetchController@fetch')->name('weddinginquiries.fetch-archive');
            Route::post('weddinginquiries/fetch-item/{id?}', 'WeddingInquiryFetchController@fetchView')->name('weddinginquiries.fetch-item');
            Route::post('weddinginquiries/fetch-pagination/{id}', 'WeddingInquiryFetchController@fetchPagePagination')->name('weddinginquiries.fetch-pagination');
        });   

        /**
        * Georeserve Policies
        */
        Route::namespace('Georeservepolicies')->group(function() {
            Route::get('georeservepolicies', 'GeoreservepolicyController@index')->name('georeservepolicies.index');
            Route::get('georeservepolicies/create', 'GeoreservepolicyController@create')->name('georeservepolicies.create');
            Route::post('georeservepolicies/store', 'GeoreservepolicyController@store')->name('georeservepolicies.store');
            Route::get('georeservepolicies/show/{id}', 'GeoreservepolicyController@show')->name('georeservepolicies.show');
            Route::post('georeservepolicies/update/{id}', 'GeoreservepolicyController@update')->name('georeservepolicies.update');
            Route::post('georeservepolicies/{id}/archive', 'GeoreservepolicyController@archive')->name('georeservepolicies.archive');
            Route::post('georeservepolicies/{id}/restore', 'GeoreservepolicyController@restore')->name('georeservepolicies.restore');
            Route::post('georeservepolicies/{id}/remove-image', 'GeoreservepolicyController@removeImage')->name('georeservepolicies.remove-image');

        
            Route::post('georeservepolicies/fetch', 'GeoreservepolicyFetchController@fetch')->name('georeservepolicies.fetch');
            Route::post('georeservepolicies/fetch/?trail={id?}/time', 'GeoreservepolicyFetchController@fetch')->name('georeservepolicies.fetch.time');
            Route::post('georeservepolicies/fetch?archived=1', 'GeoreservepolicyFetchController@fetch')->name('georeservepolicies.fetch-archive');
            Route::post('georeservepolicies/fetch-item/{id?}', 'GeoreservepolicyFetchController@fetchView')->name('georeservepolicies.fetch-item');
            Route::post('georeservepolicies/fetch-pagination/{id}', 'GeoreservepolicyFetchController@fetchPagePagination')->name('georeservepolicies.fetch-pagination');
        });

       /**
        * Newsletters
        */
        Route::namespace('Newsletters')->group(function() {
            Route::get('newsletters', 'NewsletterController@index')->name('newsletters.index');
            Route::get('newsletters/show/{id}', 'NewsletterController@show')->name('newsletters.show');
            Route::post('newsletters/{id}/archive', 'NewsletterController@archive')->name('newsletters.archive');
            Route::post('newsletters/{id}/restore', 'NewsletterController@restore')->name('newsletters.restore');

            Route::post('newsletters/fetch', 'NewsletterFetchController@fetch')->name('newsletters.fetch');
            Route::post('newsletters/fetch?archived=1', 'NewsletterFetchController@fetch')->name('newsletters.fetch-archive');
            Route::post('newsletters/fetch-item/{id?}', 'NewsletterFetchController@fetchView')->name('newsletters.fetch-item');
            Route::post('newsletters/fetch-pagination/{id}', 'NewsletterFetchController@fetchPagePagination')->name('newsletters.fetch-pagination');
            Route::post('newsletters/export-newsletters', 'NewsletterController@exportNewsletter')->name('newsletters.export-newsletters');

        });

        /**
        * Wedding Pdf
        */
        Route::namespace('Weddingpdfs')->group(function() {
            Route::get('weddingpdfs', 'WeddingpdfController@index')->name('weddingpdfs.index');
            Route::get('weddingpdfs/create', 'WeddingpdfController@create')->name('weddingpdfs.create');
            Route::post('weddingpdfs/store', 'WeddingpdfController@store')->name('weddingpdfs.store');
            Route::get('weddingpdfs/show/{id}', 'WeddingpdfController@show')->name('weddingpdfs.show');
            Route::post('weddingpdfs/update/{id}', 'WeddingpdfController@update')->name('weddingpdfs.update');
            Route::post('weddingpdfs/{id}/archive', 'WeddingpdfController@archive')->name('weddingpdfs.archive');
            Route::post('weddingpdfs/{id}/restore', 'WeddingpdfController@restore')->name('weddingpdfs.restore');
            Route::post('weddingpdfs/{id}/remove-image', 'WeddingpdfController@removeImage')->name('weddingpdfs.remove-image');

        
            Route::post('weddingpdfs/fetch', 'WeddingpdfFetchController@fetch')->name('weddingpdfs.fetch');
            Route::post('weddingpdfs/fetch/?trail={id?}/time', 'WeddingpdfFetchController@fetch')->name('weddingpdfs.fetch.time');
            Route::post('weddingpdfs/fetch?archived=1', 'WeddingpdfFetchController@fetch')->name('weddingpdfs.fetch-archive');
            Route::post('weddingpdfs/fetch-item/{id?}', 'WeddingpdfFetchController@fetchView')->name('weddingpdfs.fetch-item');
            Route::post('weddingpdfs/fetch-pagination/{id}', 'WeddingpdfFetchController@fetchPagePagination')->name('weddingpdfs.fetch-pagination');

        });

        /**
        * Event Pdf
        */
        Route::namespace('Eventpdfs')->group(function() {
            Route::get('eventpdfs','EventpdfController@index')->name('eventpdfs.index');
            Route::get('eventpdfs/create','EventpdfController@create')->name('eventpdfs.create');
            Route::post('eventpdfs/store','EventpdfController@store')->name('eventpdfs.store');
            Route::get('eventpdfs/show/{id}','EventpdfController@show')->name('eventpdfs.show');
            Route::post('eventpdfs/update/{id}','EventpdfController@update')->name('eventpdfs.update');
            Route::post('eventpdfs/{id}/archive','EventpdfController@archive')->name('eventpdfs.archive');
            Route::post('eventpdfs/{id}/restore','EventpdfController@restore')->name('eventpdfs.restore');
            Route::post('eventpdfs/{id}/remove-image','EventpdfController@removeImage')->name('eventpdfs.remove-image');

        
            Route::post('eventpdfs/fetch','EventpdfFetchController@fetch')->name('eventpdfs.fetch');
            Route::post('eventpdfs/fetch/?trail={id?}/time','EventpdfFetchController@fetch')->name('eventpdfs.fetch.time');
            Route::post('eventpdfs/fetch?archived=1','EventpdfFetchController@fetch')->name('eventpdfs.fetch-archive');
            Route::post('eventpdfs/fetch-item/{id?}','EventpdfFetchController@fetchView')->name('eventpdfs.fetch-item');
            Route::post('eventpdfs/fetch-pagination/{id}','EventpdfFetchController@fetchPagePagination')->name('eventpdfs.fetch-pagination');

        });                        

        /**
        *  Pdf Links
        */
        Route::namespace('Pdflinks')->group(function() {
            Route::get('pdflinks','PdflinkController@index')->name('pdflinks.index');
            Route::get('pdflinks/create','PdflinkController@create')->name('pdflinks.create');
            Route::post('pdflinks/store','PdflinkController@store')->name('pdflinks.store');
            Route::get('pdflinks/show/{id}','PdflinkController@show')->name('pdflinks.show');
            Route::post('pdflinks/update/{id}','PdflinkController@update')->name('pdflinks.update');
            Route::post('pdflinks/{id}/archive','PdflinkController@archive')->name('pdflinks.archive');
            Route::post('pdflinks/{id}/restore','PdflinkController@restore')->name('pdflinks.restore');
            Route::post('pdflinks/{id}/remove-image','PdflinkController@removeImage')->name('pdflinks.remove-image');

            Route::post('pdflinks/fetch','PdflinkFetchController@fetch')->name('pdflinks.fetch');
            Route::post('pdflinks/fetch/?trail={id?}/time','PdflinkFetchController@fetch')->name('pdflinks.fetch.time');
            Route::post('pdflinks/fetch?archived=1','PdflinkFetchController@fetch')->name('pdflinks.fetch-archive');
            Route::post('pdflinks/fetch-item/{id?}','PdflinkFetchController@fetchView')->name('pdflinks.fetch-item');
            Route::post('pdflinks/fetch-pagination/{id}','PdflinkFetchController@fetchPagePagination')->name('pdflinks.fetch-pagination');

        });        

        /**
        *  Bankdetails
        */
        Route::namespace('Bankdetails')->group(function() {
            Route::get('bankdetails','BankdetailController@index')->name('bankdetails.index');
            Route::get('bankdetails/create','BankdetailController@create')->name('bankdetails.create');
            Route::post('bankdetails/store','BankdetailController@store')->name('bankdetails.store');
            Route::get('bankdetails/show/{id}','BankdetailController@show')->name('bankdetails.show');
            Route::post('bankdetails/update/{id}','BankdetailController@update')->name('bankdetails.update');
            Route::post('bankdetails/{id}/archive','BankdetailController@archive')->name('bankdetails.archive');
            Route::post('bankdetails/{id}/restore','BankdetailController@restore')->name('bankdetails.restore');
            Route::post('bankdetails/{id}/remove-image','BankdetailController@removeImage')->name('bankdetails.remove-image');

            Route::post('bankdetails/fetch','BankdetailFetchController@fetch')->name('bankdetails.fetch');
            Route::post('bankdetails/fetch/?trail={id?}/time','BankdetailFetchController@fetch')->name('bankdetails.fetch.time');
            Route::post('bankdetails/fetch?archived=1','BankdetailFetchController@fetch')->name('bankdetails.fetch-archive');
            Route::post('bankdetails/fetch-item/{id?}','BankdetailFetchController@fetchView')->name('bankdetails.fetch-item');
            Route::post('bankdetails/fetch-pagination/{id}','BankdetailFetchController@fetchPagePagination')->name('bankdetails.fetch-pagination');

        });

        /**
        * Venues
        */
        Route::namespace('Venues')->group(function() {
            Route::get('venues', 'VenueController@index')->name('venues.index');
            Route::get('venues/create', 'VenueController@create')->name('venues.create');
            Route::post('venues/store', 'VenueController@store')->name('venues.store');
            Route::get('venues/show/{id}', 'VenueController@show')->name('venues.show');
            Route::post('venues/update/{id}', 'VenueController@update')->name('venues.update');
            Route::post('venues/{id}/archive', 'VenueController@archive')->name('venues.archive');
            Route::post('venues/{id}/restore', 'VenueController@restore')->name('venues.restore');
        
            Route::post('venues/fetch', 'VenueFetchController@fetch')->name('venues.fetch');
            Route::post('venues/fetch/?trail={id?}/time', 'VenueFetchController@fetch')->name('venues.fetch.time');
            Route::post('venues/fetch?archived=1', 'VenueFetchController@fetch')->name('venues.fetch-archive');
            Route::post('venues/fetch-item/{id?}', 'VenueFetchController@fetchView')->name('venues.fetch-item');
            Route::post('venues/fetch-pagination/{id}', 'VenueFetchController@fetchPagePagination')->name('venues.fetch-pagination');
        });      

    });
});