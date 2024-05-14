<template>
	<div>
		<section class="bg-dullWhite reservation-fr1 frame1">
			<div class="page-container">
				<div class="reservation-fr1__stepCon">
					<div class="reservation-fr1__stepListCon" :class="step >= 1 ? 'active' : null">
						<p>1. Experiences</p>
					</div>
					<div class="reservation-fr1__stepListCon" :class="step >= 2 ? 'active' : null">
						<p>2. Pick a Schedule</p>
					</div>
					<div class="reservation-fr1__stepListCon" :class="step >= 3 ? 'active' : null">
						<p>3. Provide Guest Details</p>
					</div>
					<div class="reservation-fr1__stepListCon" :class="step >= 4 ? 'active' : null">
						<p>4. Choose Payment Method</p>
					</div>
					<div class="reservation-fr1__stepListCon" :class="step >= 5 ? 'active' : null">
						<p>5. Review Terms and Conditions</p>
					</div>
					<div class="reservation-fr1__stepListCon" :class="step >= 6 ? 'active' : null">
						<p>6. Review and Submit Request</p>
					</div>
				</div>
			</div>
		</section>
		<section class="page-frame bg-white reservation-fr2 frame1">
			<StepOne :step-data="stepData" @stepTwoShow="stepShow(2)" @defaultNumberOfGuests="defaultNumberOfGuests()" ></StepOne>
		</section>
		<section class="page-frame bg-white reservation-fr3" v-if="step >= 2">
			<StepTwo :trail-selected="trailSelected" :step-data="stepData" :fetch-available-url="fetchAvailableUrl" :check-if-available-url="checkIfAvailableUrl" :date-checker-url="dateCheckerUrl" :fetch-fully-booked-dates-url="fetchFullyBookedDatesUrl" @stepThreeShow="stepShow(3)" @update-step></StepTwo>
		</section>

		<section class="page-frame bg-white reservation-fr4" v-if="step >= 3">
			<StepThree :trail-selected="trailSelected" :step-data="stepData" :snacks="addOns" :countries="countries" @stepFourShow="stepShow(4)" @returnToStepThree="stepShow(3)"></StepThree>
		</section>
		<section class="page-frame bg-white reservation-fr5" v-if="step >= 4">
			<StepFour :step-data="stepData" :trail-selected="trailSelected" @stepFiveShow="stepShow(5)" :bank-details="bankDetails"></StepFour>
		</section>
		<section class="page-frame bg-white reservation-fr6" v-if="step >= 5">
		<StepFive :terms-and-condition="trailSelected.terms_and_condition" :declarations="declarations"
			@stepSixShow="stepShow(6)" ></StepFive>
		</section>
		<section class="page-frame bg-white reservation-fr7" v-if="step >= 6">
		<StepFiveSec :terms-and-condition="trailSelected.terms_and_condition" :declarations="declarations" :step="step"
			@stepSevenShow="stepShow(7)" @stepSix="stepShow(6)"></StepFiveSec>
		</section>
		<section class="page-frame bg-white reservation-fr8" v-if="step >= 7">
			<StepSix :step-data="stepData" :trail-selected="trailSelected" @submitRequest="submitRequest()" :bank-details="bankDetails"></StepSix>
		</section>
		<loading :active.sync="isLoading"
		        :is-full-page="fullPage"></loading>
	</div>
</template>

<script>
	import StepOne from './steps/StepOne.vue';
	import StepTwo from './steps/StepTwo.vue';
	import StepThree from './steps/StepThree.vue';
	import StepFour from './steps/StepFour.vue';
	import StepFive from './steps/StepFive.vue';
	import StepFiveSec from './steps/StepFiveSec.vue';
	import StepSix from './steps/StepSix.vue';
	import prx_paypal_mixin from '../../../../../public/vendor/praxxys/ecommerce/paypal/js/vue-mixin.js';
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';

	export default{
		props: {
			trails: Array,
			snacks: Array,
			countries: Array,
			declarations: Array,
			bookUrl: String,
			dateCheckerUrl: String,
			fetchAvailableUrl: String,
			checkIfAvailableUrl: String,
			fetchFullyBookedDatesUrl: String,
			bankDetails: Array
		},

		mixins: [prx_paypal_mixin],

		components: {
			StepOne,
			StepTwo,
			StepThree,
			StepFour,
			StepFive,
			StepFiveSec,
			StepSix,
            Loading
		},

		data() {
			return {
				step: 1,
				stepBack: false,
				trailSelected: {},
				stepData: {
					selectedDay: null,
					selectedTime: null,
					selectedAddOns: null,
					visitPurpose: null,
					affiliation: null,
					numberOfGuests: 1,
					paymentMethod: 1,
					isFullPayment: true,
					balance: 0,
					conservationFeePerGuest: 0,
					main: {
						first_name: null,
						last_name: null,
						contact_number: null,
						birthday: null,
						email: null,
						country: 'Filipino',
						main: 1
					},
					guests:[],
				},
				addOns: this.snacks,
				isLoading: false,
                fullPage: true
			}
		},

		watch: {
			trailSelected(val) {
				if(val) {
					this.step = 1;
					this.$nextTick(() => {
						this.stepShow(2);
					}, 100)
				}
			}
		},

		mounted() {
			this.init();
		},

		methods: {

			init() {
				var dateSelected = sessionStorage.getItem('dateSelected');
				var trailSelected = JSON.parse(sessionStorage.getItem('trailSelected'));
				var numberOfGuests = JSON.parse(sessionStorage.getItem('numberOfGuests'));
				if(dateSelected != null && trailSelected != null) {
					this.stepShow(2);
					this.stepData.selectedDay = dateSelected;
					this.trailSelected = this.trails.find(t => t.id === trailSelected.id);
					this.$children[0].$data.trail = this.trailSelected;
					this.stepData.numberOfGuests = parseInt(numberOfGuests);

					// delete session storage
					sessionStorage.removeItem('dateSelected');
					sessionStorage.removeItem('trailSelected');
					sessionStorage.removeItem('numberOfGuests');
				}
			},

			stepShow(step) {
				this.step = step;
				if(sessionStorage.getItem('trailSelected') == null) {
					this.trailSelected = this.$children[0].$data.trail;
				}

				Vue.nextTick()
				.then(function() {
					setTimeout(function() {
						$('html, body').animate({
						       scrollTop: $(".reservation-fr" + (step + 1)).position().top - 110
						   }, 100);
						$('.reservation-fr1__stepCon').slick('slickGoTo', step - 1);

					}, 200)
					$('.reservation-fr1__stepCon').slick('reinit')
				})
			},



			defaultNumberOfGuests() {
				this.stepData.numberOfGuests = this.trailSelected.minimum_participant;
				this.stepData.selectedDay = null;
				this.stepData.selectedTime = {};
			},

			submitRequest() {

				if (this.stepData.selectedTime === null) {
					alert('No timeslot selected, please select a timeslot.'); return;
				}

				this.isLoading = true;
				var guests = [];
				guests.push(this.stepData.main);
				_.each(this.stepData.guests, (guest) => {
					if(guest.first_name != null) {
						guests.push(guest);
					}
				});

				var data = {
					guests: guests,
					start_time: this.stepData.selectedTime.time,
					scheduled_at: this.stepData.selectedDay,
					// total_guest: this.stepData.numberOfGuests,
					total_guest: guests.length,
					trail_name: this.trailSelected.name,
					conservation_fee: this.stepData.conservationalFee,
					conservation_fee_per_guest: this.stepData.conservationFeePerGuest,
					transaction_fee: this.stepData.transactionFees,
					sub_total: this.stepData.grandTotal,
					grand_total: this.stepData.grandTotal,
					is_paypal_payment: this.stepData.paymentMethod == 1 ? true : false,
					trail_data: JSON.stringify(this.trailSelected),
					balance: this.stepData.balance,
					amount_settled: this.stepData.amountSettled,
					is_fullpayment: this.stepData.isFullPayment,
					add_on_id: this.stepData.selectedAddOns ? this.snacks.find(x => x.name === this.stepData.selectedAddOns).id : null,
				};

				console.log(data)

				axios.post(this.bookUrl, data)
					.then((response) => {
						this.isLoading = false;
						console.log(response);
						if(response.data.visita_message === 200) {
							swal.fire({
								title: 'Request sent successfully',
								text: 'Kindly check your email for the status of your visit request. Thank you!',
								icon: 'success',
								showCancelButton: false,
				                reverseButtons: true,
								confirmButtonText: 'Confirm'
							}).then(response => {
								window.location.href = '/visitrequest';
							})
							this.clearRegistrationForm();

						} else if(response.data.visita_message == 13) {
							swal.fire("Time Slot Taken", "A booking for this time slot already exists", "warning");
							// this.stepData.guests.pop();

						} else if(response.data.visita_message == 12) {
							swal.fire("Overbooking Warning", "The capacity for this trail on the selected date has been reached. No more requests can be booked. Kindly select a different experience or schedule.", "warning");
							// this.stepData.guests.pop();

						} else if(response.data.visita_message == 11) {
							swal.fire("System Error", "Trail is not registered in the Visita system, kindly contact an admin to add the trail in under Masungi Destination", "error");
							// this.stepData.guests.pop();

						} else if(response.data.visita_message == 10) {
							swal.fire("System Error", "Masungi is not registered in Visita system, kindly contact an admin to add Masungi in their system (Required to add name = Masungi Georeserve)", "error");
							// this.stepData.guests.pop();

						}else if(response.data.visita_message == 14) {
							swal.fire("Addon required", "Please select a complimentary meal. Try again", "warning");
							// this.stepData.guests.pop();

						}else {
							swal.fire("Ooops", "Please check your input and try again", "error");
							// this.stepData.guests.pop();
						}
					})
			},

			clearRegistrationForm() {
				this.stepData = {
					selectedDay: null,
					selectedTime: null,
					selectedAddOns: null,
					visitPurpose: null,
					affiliation: null,
					numberOfGuests: 7,
					paymentMethod: 1,
					isFullPayment: true,
					main: {
						first_name: null,
						last_name: null,
						contact_number: null,
						birthday: null,
						email: null,
						country: 'selected',
						main: 1
					},
					guests:[],
				};

				this.step = 1;
				this.trailSelected = {};
			}
		}
	}
</script>
