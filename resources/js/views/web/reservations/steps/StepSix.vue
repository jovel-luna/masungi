<template>
	<div>
		<div class="page-container">
			<div class="width--90 margin-a">
				<div class="reservation__title align-c">
					<h2>Request Summary</h2>
				</div>
				<div class="width--100 margin-a inlineBlock-parent">
					<div class="width--50 reservation-fr8__leftCon">
						<div class="inlineBlock-parent">
							<div class="width--50">
								<h5>Trail</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ trailSelected.name }}</p>
							</div>
						</div>
						<div class="inlineBlock-parent">
							<div class="width--50">
								<h5>Schedule</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ toDate(stepData.selectedDay) }}</p>
							</div
							><div class="width--50">
								<h5>{{ stepData.selectedTime.trail_type_name }}</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ stepData.selectedTime.formatted_time }}</p>
							</div>
						</div>
						<div class="inlineBlock-parent">
							<div class="width--50">
								<h5>Total Number of Guests</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ totalGuestFilledUp }} Guest/s</p>
							</div
							><div class="width--50">
								<h5>Purpose of Visit</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ stepData.visitPurpose }}</p>
							</div
							><div class="width--50">
								<h5>Complimentary Light Snack</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ stepData.selectedAddOns != null ? stepData.selectedAddOns : '---' }}</p>
							</div
							><div class="width--50">
								<h5>Affiliation</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ stepData.affiliation }}</p>
							</div
							><div class="width--50">
								<h5>Lead Guest Name</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ stepData.main.first_name }} {{ stepData.main.last_name }}</p>
							</div
							><div class="width--50">
								<h5>Contact Number</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ stepData.main.contact_number }}</p>
							</div
							><div class="width--50">
								<h5>Email Address</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ stepData.main.email }}</p>
							</div
							><div class="width--50">
								<h5>Country</h5>
							</div
							><div class="width--50 align-r">
								<p>{{ country }}</p>
							</div
							>
						</div>
					</div
					><div class="width--50 reservation-fr8__rightCon">
						<div class="inlineBlock-parent" v-if="stepData.guests.length">
							<div class="width--50">
								<h5>Other Guest Names</h5>
							</div
							><div class="width--50 align-r reservation-fr8__selectCon">
								<input type="text" :placeholder="selectedGuest.name" disabled>
								<p>{{ selectedGuest.name }}</p>
								<div class="selector" @click="showGuestsList()"></div>
								<ul>
									<li  v-for="(guest, key) in stepData.guests" :data-id="'guest-'+key" @click="selectGuest(guest, key)">{{ guest.first_name }} {{ guest.last_name }}</li>
								</ul>
							</div>
							<!-- {{-- COMPONENT_OTHER_GUEST_DETAILS --}} -->
							<div class="width--100 reservation-fr8__otherGuestCon" v-for="(guest,key) in stepData.guests" :data-target="'guest-'+key" v-show="showGuestDetail">
								<div class="inlineBlock-parent">
									<div class="width--50">
										<h5>Contact Number</h5>
									</div
									><div class="width--50 align-r">
										<p>{{ guest.contact_number }}</p>
									</div
									><div class="width--50">
										<h5>Email Address</h5>
									</div
									><div class="width--50 align-r">
										<p>{{ guest.email }}</p>
									</div
									><div class="width--50">
										<h5>Country</h5>
									</div
									><div class="width--50 align-r">
										<p>{{ guest.country }}</p>
									</div>
								</div>
							</div>
						</div>
						<div class="inlineBlock-parent">
							<div class="width--50">
								<h5>Payment Method <span class="m-margin-l type-2">Pending</span></h5>
							</div
							><div class="width--50 align-r">
								<p>{{ renderPaymentMethod }}</p>
							</div
							><div class="width--50">
								<h5 v-if="!stepData.isFullPayment">Partial Conservation Fee</h5>
								<h5 v-if="stepData.isFullPayment">Full Conservation Fee</h5>
							</div
							><div class="width--50 align-r">
								<p>P {{ stepData.isFullPayment ? withComma(conservationalFee) : withComma(conservationalFee / 2) }}</p>
							</div>
							<div class="width--60" v-if="stepData.paymentMethod == 1">
								<h5>Paypal Service Charge</h5><small>(4.4% of the {{ stepData.isFullPayment ? 'full' : 'partial' }} conservation fee + Php 15 is applied per transaction)</small>
							</div
							><div class="width--40 align-r" v-if="stepData.paymentMethod == 1">
								<p>P {{ stepData.isFullPayment ? withComma(transactionFees, 2) : withComma(transactionFees / 2, 2) }}</p>
							</div>
							<template v-if="!stepData.isFullPayment"> 
							<div class="width--50">
                                                                <h5>Initial Payment</h5>
                                                        </div
                                                        ><div class="width--50 align-r">
                                                                <p>P {{ withComma((conservationalFee + transactionFees) / 2) }}</p>
                                                        </div>
							</template>
							<!--<div class="width--50">
								<h5 v-if="!stepData.isFullPayment">Initial Payment</h5>
								<h5 v-if="stepData.isFullPayment">Full Payment</h5>
							</div
							><div class="width--50 align-r">
								<p>P {{ !stepData.isFullPayment ? withComma((conservationalFee + transactionFees) / 2) : withComma(conservationalFee) }}</p>
							</div>-->
							<template v-if="!stepData.isFullPayment">
								<div class="width--50">
									<h5>Remaining Balance Payment</h5>
								</div
								><div class="width--50 align-r">
									<p>P {{ withComma(nextPayment) }}</p>
								</div>
							</template>
							<div class="width--50">
								<h5>Total Payment</h5>
							</div
							><div class="width--50 align-r">
								<p>P {{ withComma(grandTotal)  }}</p>
							</div
							>
						</div>
						<div class="inlineBlock-parent">
							<div class="width--50">
								<h5>Declarations</h5>
							</div
							><div class="width--50 align-r">
								<p>All Accepted</p>
							</div>
						</div>
						<div class="reservation-fr8__buttonCon align-r">
							<button class="button type-1" @click="$emit('submitRequest')"><span>Submit Request</span><img src="images/images/icons/arrow.png"></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import DateMixin from 'Mixins/date.js';
	import NumberMixin from 'Mixins/number.js';

	export default {
		props: {
			trailSelected: Object,
			stepData: Object
		},

		mixins: [ DateMixin, NumberMixin ],

		data() {
			return {
				selectedGuest: {},
				showGuestDetail: false
			}
		},

		computed: {

			totalGuestFilledUp() {
				var res = 1;
				_.each(this.stepData.guests, (guest) => {
					if(!guest.disabled) res++;
				});

				/* According to their business rules, guests are still to pay for the number of minimum guests even if they don't meet the minimum number */
				if(this.trailSelected.minimum_participant > res) {
					res = this.trailSelected.minimum_participant;
				}
				return res;
			},
			
			conservationalFee() {
				// var feePerHead = parseFloat(this.trailSelected.fee_per_guest);
				var feePerHead = parseFloat(this.trailSelected.weekday_fee);
				var visitDate = moment(this.stepData.selectedDay+" "+this.stepData.selectedTime.time);
				var is_weekend = (visitDate.day() === 6) || (visitDate.day() === 0);
				
				var guestsInput = parseFloat(this.stepData.numberOfGuests);
				var guestsTotal = this.totalGuestFilledUp;
				
				if(is_weekend) {
					feePerHead = parseFloat(this.trailSelected.weekend_fee);					
				} 
				
				this.stepData.conservationalFee = guestsTotal * feePerHead;
				this.stepData.conservationFeePerGuest = feePerHead;
				return guestsTotal * feePerHead;
			},

			transactionFees() {
				var paypalFee = 4.4 / 100;
				var add = 15;
				var conservationalFeexPaypalFee = 0;
				var total = 0;
				if(!this.stepData.isFullPayment) {
					paypalFee = 8.8 / 100;
					add = 30;
					conservationalFeexPaypalFee = parseFloat((this.conservationalFee / 2) * paypalFee);
					total = conservationalFeexPaypalFee + add;
				} else {
					conservationalFeexPaypalFee = parseFloat(this.conservationalFee * paypalFee);
					total = conservationalFeexPaypalFee + add;
				}
				
				if(this.stepData.paymentMethod != 1) {
					total = 0;	
				}
				this.stepData.transactionFees = total;
				return total;
			},

			grandTotal() {
				var conservationalFee = this.conservationalFee;
				var charges = 0;
				if(this.stepData.paymentMethod == 1) {
					charges = this.transactionFees;
				}
				var total = parseFloat(charges) + parseFloat(conservationalFee);

				this.stepData.grandTotal = total;
				return total;
			},

			initialPayment() {
				var isFullPayment = this.stepData.isFullPayment;
				var total = this.grandTotal;

				if(!isFullPayment) {
					total = this.conservationalFee / 2;
					if(this.stepData.paymentMethod === 1 && !this.stepData.isFullPayment) {
						total += (this.transactionFees / 2);
					}
				}

				this.stepData.amountSettled = total;

				return total;
			},

			amountToSettle() {
				var isFullPayment = this.stepData.isFullPayment;
				var label = 'Half payment';

				if(isFullPayment) {
					label = 'Full payment';
				}


				return label;
			},

			nextPayment() {
				var isFullPayment = this.stepData.isFullPayment;
				var conservationalFee = this.conservationalFee;
				var total = 0;

				if(!isFullPayment) {
					total = (this.conservationalFee / 2) + (this.transactionFees / 2);
				}

				this.stepData.balance = total;

				return total;
			},

			renderPaymentMethod() {
				return this.stepData.paymentMethod === 0 ? 'Bank Deposit' : 'PayPal';
			},

			country() {
				var selectedCountry = this.stepData.main.country;
				var countries = this.$parent.$props.countries;
				var label = null;
				_.each(countries, (country) => {
					if(country.citizenship === selectedCountry) {
						label = country.name
					}
				})

				return label;
			}
		},

		methods: {
			showGuestsList() {
				$('.selector').parent().find('ul').slideDown(300);
			},
			selectGuest(guest, key) {
				this.showGuestDetail = true;
				this.selectedGuest.key = key;
				this.selectedGuest.name = guest.first_name +' '+ guest.last_name;
				this.selectedGuest.contact_number = guest.contact_number;
				this.selectedGuest.email = guest.email;
				this.selectedGuest.country = guest.country;
				// $('.reservation-fr8__otherGuestCon').removeClass('active');
				// $('.reservation-fr8__otherGuestCon[data-target="guest-' + key + '"]').addClass('active');

				$('.reservation-fr8__selectCon ul li').on('click', function(){
					var targetGuestLabel = $(this).text();
					var targetGuest = $(this).data('id');

					$('.reservation-fr8__selectCon ul').slideUp(300);
					$('.reservation-fr8__selectCon p').text(targetGuestLabel);

					$('.reservation-fr8__otherGuestCon').removeClass('active');
					$('.reservation-fr8__otherGuestCon[data-target="' + targetGuest + '"]').addClass('active');
				})
			},
		}
	}
</script>
