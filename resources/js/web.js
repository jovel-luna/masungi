Vue.component('dialog-container', require('./components/dialogs/DialogContainer.vue').default);

Vue.component('article-list', require('./views/web/articles/ArticleList.vue').default);
Vue.component('selected-article', require('./views/web/articles/SelectedArticle.vue').default);

// Vue.component('calendar', require('./views/web/calendar.vue').default);

Vue.component('reservation', require('./views/web/reservations/Reservation.vue').default);

Vue.component('payment', require('./views/web/payments/PaymentPaypal.vue').default);


Vue.component('calendar', require('./views/web/calendar.vue').default);

/*Destinations Page*/
Vue.component('key-list', require('./views/web/destinations/keyList.vue').default);

/*Experiences Page*/
Vue.component('beyond-list', require('./views/web/experiences/beyondList.vue').default);

/*Event Page*/
Vue.component('wedding-package-list', require('./views/web/events/weddingPackageList.vue').default);
Vue.component('wedding-gallery-list', require('./views/web/events/weddingGalleryList.vue').default);

/*Georeserve Policies Page*/
Vue.component('georeserve-list', require('./views/web/georeserve/georeserveList.vue').default);

/*Projects and Collaborators Page*/
Vue.component('project-list', require('./views/web/projects/projectList.vue').default);

/*Research Page*/
Vue.component('research-list', require('./views/web/research/researchList.vue').default);

/*Information Kits Page*/
Vue.component('package-list', require('./views/web/informationKits/packageList.vue').default);

/*Trail Selection*/
Vue.component('trail-selection', require('./views/web/trails/TrailSelection.vue').default);

/*Contact Us*/
Vue.component('contact-us-form', require('./views/web/inquiries/ContactUsForm.vue').default);
Vue.component('company-inquiry-form', require('./views/web/inquiries/CompanyInquiryForm.vue').default);
Vue.component('school-visit-form', require('./views/web/inquiries/SchoolVisitForm.vue').default);
Vue.component('wedding-inquiry-form', require('./views/web/inquiries/WeddingInquiryForm.vue').default);

/*Newsletter*/
Vue.component('newsletter-form', require('./views/web/newsletters/NewsletterForm.vue').default);

/*Site Locator*/
Vue.component('store-locator', require('./views/web/stores/StoreLocator.vue').default);

/*Home Page Reservation*/
Vue.component('home-reservation', require('./views/web/reservations/HomePageReservation.vue').default);

Vue.component('news', require('./views/web/news/News.vue').default);
Vue.component('more-news', require('./views/web/news/MoreNews.vue').default);
Vue.component('news-page-view', require('./views/web/news/NewsPageView.vue').default);