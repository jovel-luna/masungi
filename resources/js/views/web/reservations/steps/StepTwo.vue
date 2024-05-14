<template>
	<div>
		<div class="page-container">
			<div class="width--90 margin-a">
				<div class="reservation__title align-c">
					<h2>Select Schedule</h2>
				</div>
				<div class="width--100 margin-a inlineBlock-parent">
					<div class="width--50 align-t">
						<div class="cstm-calendar">
							<FullCalendar defaultView="dayGridMonth" :events="events" :unselect-auto="false" :selectable="true" :plugins="calendarPlugins" :day-render="dayRender" :default-date="stepData.selectedDay" :header="header" @dateClick="selectedDate" ref="fullCalendar"/>
						    <div class="inlineBlock-parent">
						      	<div class="calendar__label"></div><p class="font-2">Fully Committed</p>
						    </div>
						</div>
					</div
					><div class="width--50 align-t">
						<div class="reservation-fr3__label align-c">
							<p class="font-2">Kindly select a date to display time</p>
						</div>
						<form>
							<div class="form__con inlineBlock-parent">
								<div class="width--30 align-t">
									<div class="inlineBlock-parent reservation-fr3__formLabel">
										<img src="images/images/icons/sun.svg">
										<p>Day Trail</p>
									</div>
									<div class="form-group">
										<template v-for="time in dayTrailTimeSlots">
											<input type="radio" name="timeTrail" :value="time" v-model="stepData.selectedTime" :disabled="time.is_block"><label for="530am" :class="disableRadio(time.is_block)">{{ time.formatted_time }}</label><br>
										</template>
									</div>
								</div
								><div class="width--40 align-t">
									<div class="inlineBlock-parent reservation-fr3__formLabel">
										<img src="images/images/icons/sun.svg">
										<img src="images/images/icons/night.svg">
										<p>Day / Night Trail</p>
									</div>
									<div class="form-group">
										<template v-for="time in dayNightTrailTimeSlots">
											<input type="radio" name="timeTrail" :value="time" v-model="stepData.selectedTime" :disabled="time.is_block"><label for="530am">{{ time.formatted_time }}</label><br>
										</template>
									</div>
								</div
								><div class="width--30 align-t">
									<div class="inlineBlock-parent reservation-fr3__formLabel">
										<img src="images/images/icons/night.svg">
										<p>Night Trail</p>
									</div>
									<div class="form-group">
										<template v-for="time in nightTrailTimeSlots">
											<input type="radio" name="timeTrail" :value="time" v-model="stepData.selectedTime" :disabled="time.is_block"><label for="530pm">{{ time.formatted_time }}</label><br>
										</template>
									</div>
								</div>
							</div>
							<!-- <h2 class="pt-4 text-center" v-if="timeslots.length == 0 && hasSelectedDate">All time slots have been taken</h2> -->
						</form>
						<div class="reservation-fr3__buttonCon align-r" v-if="isDataComplete">
							<button class="button type-1" @click="$emit('stepThreeShow')"><span>Provide Guest Details</span><img src="images/images/icons/arrow.png"></button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<loading :active.sync="isLoading"
		        :is-full-page="true"></loading>
	</div>
</template>
<script>
	import FullCalendar from '@fullcalendar/vue'
	import dayGridPlugin from '@fullcalendar/daygrid'
	import interactionPlugin from '@fullcalendar/interaction'
	import calendar from '../../calendar.vue';
	import Loading from 'vue-loading-overlay';
	import 'vue-loading-overlay/dist/vue-loading.css';

	export default {
		props: {
			trailSelected: Object,
			stepData: Object,
			dateCheckerUrl: String,
			fetchAvailableUrl: String,
			checkIfAvailableUrl: String,
			fetchFullyBookedDatesUrl: String
		},

		data() {
			return {
				calendarPlugins: [ dayGridPlugin, interactionPlugin ],
				events: [],
				header: {
				  center: "title",
				  left: "prev",
				  right: 'next'
				},

				timeslots: [],
				selectedDay: null,
				dayTrailTimeSlots: [],
				nightTrailTimeSlots: [],
				dayNightTrailTimeSlots: [],
				fullyBookedDates: [],
				isLoading: false,
				slots: [],
				hasSelectedDate: false
			}
		},

		components: {
			calendar,
            Loading
		},

		computed: {
			isDataComplete() {
				var bool = false;
				var stepData = this.stepData;

				if(stepData.selectedDay != null && stepData.selectedTime !== null && Object.keys(stepData.selectedTime).length > 0) {
					bool = true;
				}

				return bool;
			},

			validRange() {
				var valid = {
						start: moment().format('YYYY-MM-DD'),
					}
				return  valid;
			},
		},

		mounted() {
			// Disabled for now since loading takes a long time to complete
			// this.fetchFullyBookedDates();
			this.$refs.fullCalendar;
			this.init();
		},

		watch: {
			slots: function(val) {
				this.dayRender();
			}
		},

		methods: {
			async checkAvailability (date,experience_id){
				axios.post(this.checkIfAvailableUrl,{'date':date,'experience':experience_id})
				.catch(error => {
					console.log(error);
				})
				.finally((response) => {
					return response;
				})
			},
			fetchFullyBookedDates() {
				this.isLoading = true;

				let data = {
					'trail_name': this.trailSelected.name,
					'trail_id': this.trailSelected.id
				};

				axios.post(this.fetchFullyBookedDatesUrl, data)
					.then(response => {
						var data = response.data;
						// Assign array to variable
						this.fullyBookedDates = data.fully_booked_dates;

						// Block dates with no available timeslots
						this.dayRender();
						this.isLoading = false;
					}).catch(error => {
							console.log(error);
					});
			},

			fetchAvailableMondays() {
				// retrieve and save available slots to array
				axios.post(this.fetchAvailableUrl)
					.then((response) => {
						_.each(response.data.slots, (value) => {
							var experience_name = '';
							if(value.experience == '61'){
								experience_name = 'Discovery Trail';
							}else if(value.experience  == '62'){
								experience_name = 'Legacy Trail';
							}else{
								experience_name = 'Garden Picnic';
							}
							this.slots.push(value.selected_date+'@'+experience_name);
						})
					})
			},

			init() {
				this.dayRender();
				console.log(this.slots)
				console.log(this.trailSelected.name)
				console.log('here')
				if(this.stepData.selectedDay != null) {
					this.$refs.fullCalendar.getApi().select(this.stepData.selectedDay);
					this.isLoading = true;
					// get all the available timeslots
				  	axios.post(this.dateCheckerUrl, { 'date': this.stepData.selectedDay, 'trail_name': this.trailSelected.name, 'trail_id': this.trailSelected.id })
				  		.then(response => {
				  			var data = response.data;
							this.timeslots = data.timeslots;
				  			_.each(data.timeslots, (timeslot) => {
				  				if(timeslot.trail_type_id == 1) {
				  					this.dayTrailTimeSlots.push(timeslot);
				  				}

				  				if(timeslot.trail_type_id == 2) {
				  					this.nightTrailTimeSlots.push(timeslot);
				  				}

				  				if(timeslot.trail_type_id == 3) {
				  					this.dayNightTrailTimeSlots.push(timeslot);
				  				}
				  			})
							this.isLoading = false;
				  		}).catch(error => {
							console.log(error);
						})
				}
			},

			selectedDate(e) {
				this.hasSelectedDate = true;
				// Disable to click Past and Block Dates
				let action = true;
				let result = null;
				let classList = Array.apply(null, e.jsEvent.srcElement.offsetParent.classList);
				var cutoff_date = moment().add(this.trailSelected.cut_off, 'day').format('YYYY-MM-DD');

				if(moment(e.dateStr) < moment().subtract(1, 'days') || moment(e.dateStr).isBefore(cutoff_date)) { action = false }

				// check for odd table selected element
				if((e.jsEvent.srcElement.localName === "table" || e.jsEvent.srcElement.localName === "div") && e.jsEvent.srcElement.querySelector(`td[data-date="${e.dateStr}"]`).classList && e.jsEvent.srcElement.querySelector(`td[data-date="${e.dateStr}"]`).classList.contains("fc-other-month")) {
					action = false;
				}

				if(classList.includes("fc-other-month") || e.jsEvent.srcElement.classList.contains("fc-other-month")) {
					action = false;
				} else {
					// For Mobile Selects the selected date and add class
					var target = e.dateStr
					$('td').removeClass('mobile-active');
					$('td[data-date="' + target + '"]').addClass('mobile-active');
				}

				// invalid date selected
				if(!action) {
					this.dayTrailTimeSlots = [];
					this.nightTrailTimeSlots = [];
					this.dayNightTrailTimeSlots = [];
					this.stepData.selectedDay = null;
					this.stepData.selectedTime = null;
					return;
				}

				this.isLoading = true;
				this.dayTrailTimeSlots = [];
				this.nightTrailTimeSlots = [];
				this.dayNightTrailTimeSlots = [];

			var day = moment(e.date).format('dddd');
			  	this.selectedDay = moment(e.date).format('Y-MM-DD');
			  	this.stepData.selectedDay = moment(e.date).format('Y-MM-DD');

				

			  	// get all the available timeslots
			  	axios.post(this.dateCheckerUrl, { 'date': this.stepData.selectedDay, 'trail_name': this.trailSelected.name , 'trail_id': this.trailSelected.id })
			  		.then(response => {
			  			var data = response.data;
						this.timeslots = data.timeslots;

			  			_.each(data.timeslots, (timeslot) => {
			  				if(timeslot.trail_type_id == 1) {
			  					this.dayTrailTimeSlots.push(timeslot);
			  				}

			  				if(timeslot.trail_type_id == 2) {
			  					this.nightTrailTimeSlots.push(timeslot);
			  				}

			  				if(timeslot.trail_type_id == 3) {
			  					this.dayNightTrailTimeSlots.push(timeslot);
			  				}
			  			})
						this.isLoading = false;

						// check timeslot selection
						console.log(this.dayTrailTimeSlots.length)
						if(!this.dayTrailTimeSlots.length || !this.stepData.selectedTime || !this.dayTrailTimeSlots.find(s => s.time === this.stepData.selectedTime.time)) {
						    this.stepData.selectedTime = null;
						}
			  		}).catch(error => {
						console.log(error);
					})

			  	var el = this.$refs.fullCalendar.$el.getElementsByClassName('fc-other-month');
			  	var today = moment().format('YYYY-MM-DD');

			  	_.each(this.trailSelected.blocked_dates, (date) => {
			  		if(date.date == this.selectedDay) {
			  			if(date.is_whole_day) {
			  				this.selectedDay = null;
			  				this.stepData.selectedDay = null;
			  			}
			  		}
			  	});

				this.dayRender();

			  	// _.each(el, (element) => {
		  		// 	if($(element).attr('data-date') < today) {
		  		//         this.selectedDay = null;
		  		//         this.stepData.selectedDay = null;
		  		//         console.log('x')
		  		//     }
			  	// });

			},

			dayRender() {
			  	var el = this.$refs.fullCalendar.$el.getElementsByClassName('fc-day-top');
			  	var today = moment().add(this.trailSelected.cut_off, 'day').format('YYYY-MM-DD');
			  	var first_available_date = moment(moment().format('YYYY-MM-DD'), 'YYYY-MM-DD').add(4, 'days');
				
				console.log('first date');
				console.log(first_available_date);

				var slot_list = [];
				
				_.each(this.slots, (item) => {
					slot_list.push(item)
				})

			  	// render the block dates
			  	_.each(this.trailSelected.blocked_dates, (date) => {
			  		if(date.is_whole_day) {
			  			_.each(el, (element) => {
			  		    	if($(element).attr('data-date') === date.date) {
				  		      	$(element).addClass('fc-other-month');
								this.timeslots = [];
			  		    	}
			  			})
			  		}
			  	})

				// Block all days that have no available timeslots
				_.each(this.fullyBookedDates, (date) => {
					_.each(el, (element) => {
						if($(element).attr('data-date') === date) {
							$(element).addClass('fc-other-month');
							this.timeslots = [];
						}
					})
				})

			  	// block the past date
			  	_.each(el, (element) => {
					

					if($(element).attr('data-date') < today) {
					
			  	        $(element).addClass('fc-other-month');
						  this.timeslots = [];
			  	    }


					var threeDays = moment().add(3, 'days').format('YYYY-MM-DD');
					// console.log(moment($(element).attr('data-date')).format('YYYY-MM-DD'))
					// console.log('threeDays')

					// console.log(threeDays)
					// disable dates 3 days from current day
					if(moment($(element).attr('data-date')).format('YYYY-MM-DD') < threeDays) {

						console.log('disable dates 3 days')
						console.log(moment($(element).attr('data-date')))

			  	        $(element).addClass('fc-other-month');
						  this.timeslots = [];
			  	    
					}

					// disable dates not allowed today
					if(moment($(element).attr('data-date')) <= first_available_date) {

						console.log('disable dates')
						console.log(moment($(element).attr('data-date')))

			  	        $(element).addClass('fc-other-month');
						  this.timeslots = [];
			  	    }

					
					if(moment($(element).attr('data-date')).format('dddd') === 'Monday'){
						//console.log(slot_list.includes($(element).attr('data-date')+'@'+this.trailSelected.name))
						if(slot_list.includes($(element).attr('data-date')+'@'+this.trailSelected.name)){
							$(element).removeClass('fc-other-month');
						}else{
							$(element).addClass('fc-other-month');
							this.timeslots = [];
						}
					}
			  	})
				
			},

			disableRadio(is_block) {
				var _class = null;

				if(is_block) {
					_class = 'is-disable__radio';
				}
				return _class;
			}
		},
		created: function(){
			this.fetchAvailableMondays();
		}
	}
</script>