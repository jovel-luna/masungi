<template>
	<div>
		<div class="page-container">
			<div class="width--90 margin-a">
				<div class="page-general inlineBlock-parent">
					<div class="width--25 page-sideNav align-t">
						<div class="to-desk fadeIn">
							<ul>
								<li class="page-tabSelect"><a @click="showContent(0)" :class="contentToShow === 0 ? 'active' : null">Overview</a></li>
								<li class="page-tabSelect"><a @click="showContent(1)" :class="contentToShow === 1 ? 'active' : null">Area Characteristics</a></li>
								<li class="page-tabSelect"><a @click="showContent(2)" :class="contentToShow === 2 ? 'active' : null">Features</a></li>
								<li class="page-tabSelect"><a @click="showContent(3)" :class="contentToShow === 3 ? 'active' : null">Ideal For</a></li>
								<li class="page-tabSelect"><a @click="showContent(4)" :class="contentToShow === 4 ? 'active' : null">Inclusions</a></li>
								<li class="page-tabSelect"><a @click="showContent(5)" :class="contentToShow === 5 ? 'active' : null">Good to Know</a></li>
								<li class="page-tabSelect"><a @click="showContent(6)" :class="contentToShow === 6 ? 'active' : null">Conservation Fees</a></li>
								<li class="page-tabSelect"><a @click="showContent(7)" :class="contentToShow === 7 ? 'active' : null">Visit Request Process</a></li>
							</ul>
							<template v-if="trail.is_special_event">
								<a :href="ContactUsUrl"><button class="button type-1 no-icon m-margin-t"><span>Contact Us to Join</span></button></a>
							</template>
							<template v-else>
								<a href="/visitrequest"><button class="button type-1 no-icon m-margin-t"><span>Request to Visit</span></button></a>
							</template>
						</div>
						<div class="to-mob fadeIn">
							<select class="select" v-model="contentToShow">
								<option :value="0">Overview</option>
								<option :value="1">Area Characteristics</option>
								<option :value="2">Features</option>
								<option :value="3">Ideal For</option>
								<option :value="4">Inclusions</option>
								<option :value="5">Good to Know</option>
								<option :value="6">Conservation Fees</option>
								<option :value="7">Visit Request Process</option>
							</select>
						</div>
					</div
					><div class="width--75 page-mainContent align-t fadeIn">
						<div class="" v-show="contentToShow === 0">
							<h2>Overview</h2>
							<span v-html="trail.overview"></span>
						</div>
						<div class="" v-show="contentToShow === 1">
							<h2>Area Characteristic</h2>
							<span v-html="trail.characteristic"></span>
						</div>
						<!-- {{-- COMPONENT_FOR_IMAGE_LIST --}} -->
						<div class="" v-show="contentToShow === 2">
							<h2>Features</h2>
							<div class="page-grid grid-3">
								<!-- {{-- COMPONENT_GRID_CHILD --}} -->
								<div class="page__gridChild" v-for="stop in trailStops">
									<div class="page-grid__imgCon" :style="{ backgroundImage: `url(${stop.fullpath})` }"></div>
									<div class="page-grid__textConPrev">
										<h2>{{ stop.name }}</h2>
									</div>
									<div class="page-grid__textCon">
										<div class="page-grid__limitCon">
											<div>
												<h2>{{ stop.name }}</h2>
												<div class="page-grid__text" v-html="stop.description"></div>
											</div>
										</div>
									</div>
								</div>
								<!-- {{-- END_COMPONENT_GRID_CHILD --}} -->
							</div>
						</div>
						<!-- {{-- END_COMPONENT_FOR_IMAGE_LIST --}} -->
						<div class="" v-show="contentToShow === 3">
							<h2>Ideal For</h2>
							<span v-html="trail.ideal_for"></span>
						</div>
						<div class="" v-show="contentToShow === 4">
							<h2>Inclusions</h2>
							<span v-html="trail.inclusions"></span>
						</div>
						<div class="" v-show="contentToShow === 5">
							<h2>Good To Know</h2>
							<span v-html="trail.good_to_know"></span>
						</div>
						<div class="" v-show="contentToShow === 6">
							<h2>Conservation Fee</h2>
							<p>Php {{ trail.weekday_fee }}/guest on weekdays</p>
							<p>Php {{ trail.weekend_fee }}/guest on weekends</p>
						</div>
						<div class="" v-show="contentToShow === 7">
							<h2>Visit Request Process</h2>
							<span v-html="trail.visit_request_process"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			trail: Object,
			trailStops: Array,
			ContactUsUrl: String
		},

		data() {
			return {
				contentToShow: 0,
				content: 0,
			}
		},

		methods: {
			showContent(content) {
				this.contentToShow = content;
			},
		}
	}
</script>