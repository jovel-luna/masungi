<template>
	<div>
		<div class="page-container">
			<div class="width--90 margin-a">
				<div class="reservation__title align-c">
					<h2>Experiences</h2>
				</div>
				<div class="width--100 margin-a">
					<!-- {{-- COMEONENT_CARD_TRAIL --}} -->
					<div class="reservation-fr2__trailCard inlineBlock-parent" v-for="(trail, key) in trails" v-if="trail.id !== '2'">
						<div class="width--40">
							<div class="reservation-fr2__imgCon" :style="{ backgroundImage : 'url('+trail.path+')' }"></div>
						</div
						><div class="width--60">
							<h2 class="m-margin-b">{{ trail.name }}</h2>
							<div class="inlineBlock-parent m-margin-b">
								<div class="width--33 align-t">
									<h5>Estimated Duration:</h5>
									<p>{{ trail.duration }}</p>
								</div
								><div class="width--33 align-t">
									<h5>Recommended for:</h5>
									<p>{{ trail.recommended }}</p>
								</div
								><div class="width--33 align-t">
									<h5>Minimum Guests:</h5>
									<p>{{ trail.minimum_participant }} Guest/s</p>
								</div>
							</div>
							<div class="reservation-fr2__textCon m-margin-b">
								<h5>Overview</h5>
								<p v-html="trail.short_description" v-if="key != keyShow"></p>
								<p v-html="trail.full_description" v-if="key === keyShow"></p>
							</div>
							<div class="reservation-fr2__actionCon inlineBlock-parent">
								<div class="width--50 align-l">
									<p v-if="key === keyShow"><a @click="viewMore(key, false)" style="cursor: pointer;" >View Less</a></p>
									<p v-else><a @click="viewMore(key)" style="cursor: pointer;" >View More</a></p>
								</div
								><div class="width--50  align-r">
									<button class="button type-1" @click="selectedTrail(trail); $emit('stepTwoShow'); $emit('defaultNumberOfGuests'); "><span>Pick a Schedule</span><img src="images/images/icons/arrow.png"></button>
								</div>
							</div>
						</div>
					</div>
					<div v-else>
					{{ trail }}
					test check
					</div>
					<!-- {{-- END_COMPONENT_CARD_TRAIL --}} -->
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		data() {
			return {
				trails: [],
				trail: {},
				showShortDescription: true,
				keyShow: null
			}
		},

		mounted() {
			this.trails = this.$parent._props.trails;
		},

		methods: {
			selectedTrail(trail) {
				this.trail = trail
			},

			viewMore(key, show=true) {
				this.keyShow = key;
				this.showShortDescription = !this.showShortDescription;
				
				if(!show) {
					this.keyShow = null;
				}
			}
		}
	}
</script>