<template>
	<div>
		<div class="page-container">
			<div class="width--90 margin-a">
				<div class="reservation__title align-c">
					<h2>Payment Details</h2>
				</div>
				<div class="width--100 margin-a">
					<div class="inlineBlock-parent width--80 margin-a">
						<div class="width--50 reservation-fr5__leftCon align-t">
							<h2 class="font-3 type-1">Mode of Payment</h2>
							<div class="form-group l-margin-b">
								<template v-for="detail in bankDetails">
									<template v-if="detail.name != 'PayPal'">
										<input type="radio" id="bank" name="paymentMode" :value="0" v-model="stepData.paymentMethod">
										<label for="bank">{{ detail.name }}</label>
									</template>
									<template  v-if="detail.name == 'PayPal'">
										<input type="radio" id="card" name="paymentMode" :value="1" v-model="stepData.paymentMethod">
										<label for="card">{{ detail.name }} (Additional Paypal charges may apply)</label>
									</template>
								</template>
							</div>
							
							<h2 class="font-3 type-1">Amount to settle</h2>
							<div class="form-group">
								<input type="radio" id="fullpayment" name="amount_settled" :value="true" v-model="stepData.isFullPayment"><label for="fullpayment"> Full Payment (100%)</label><br><br>
								<template v-if="halfPaymentAvailability">
									<input type="radio" id="halfpayment" name="amount_settled" :value="false" v-model="stepData.isFullPayment"><label for="halfpayment">Half Payment (50%) </label>
								</template>
							</div>
						</div
						><div class="width--50 reservation-fr5__rightCon align-t">
							<h2 class="font-3 type-1">Fee Details</h2>
							<div class="reservation-fr5__paymentDetails">
								<div class="inlineBlock-parent">
									<div class="width--60">
										<p>Conservation Fee per Guest</p>
									</div
									><div class="width--40 align-r">
										<p class="bold">P {{ withComma(feePerHead) }}</p>
									</div
									><div class="width--60">
										<p>Number of Guests</p>
									</div
									><div class="width--40 align-r">
										<!-- <p class="bold">x {{ stepData.numberOfGuests }}</p> -->
										<p class="bold">x {{ totalGuestFilledUp }}</p>
									</div
									><div class="width--60">
										<p>Total</p>
									</div
									><div class="width--40 align-r">
										<p class="bold">P {{ withComma(conservationalFee) }}</p>
									</div>
								</div>
								<div class="inlineBlock-parent">
									<div class="width--60">
										<p>Amount to Settle</p>
									</div
									><div class="width--40 align-r">
										<p>{{ amountToSettle }}</p>
									</div>
								</div>
								<div class="inlineBlock-parent">
									<div class="width--60">
										<p v-if="!stepData.isFullPayment">Partial Conservation Fee</p>
										<p v-if="stepData.isFullPayment">Full Conservation Fee</p>
									</div
									><div class="width--40 align-r">
										<p class="bold">P {{ !stepData.isFullPayment ? withComma(conservationalFee / 2) : withComma(conservationalFee) }}</p>
									</div
									><div class="width--60" v-if="stepData.paymentMethod == 1">
										<p>Paypal Service Charge <small>(4.4% of the {{ stepData.isFullPayment ? 'full' : 'partial' }} conservation fee + Php 15 is applied per transaction)</small></p>
									</div
									><div class="width--40 align-r" v-if="stepData.paymentMethod == 1">
										<p class="bold">P {{ stepData.isFullPayment ? withComma(transactionFees, 2) : withComma(transactionFees / 2, 2) }}</p>
									</div>
								</div>
								<div class="inlineBlock-parent">
									<div class="width--60">
										<p v-if="!stepData.isFullPayment" class="z-margin-b">Initial Payment</p>
										<p v-if="stepData.isFullPayment" class="z-margin-b">Full Payment</p>
										<h6 class="font-2 type-red">Due 3 banking days after approval</h6>
									</div
									><div class="width--40 align-r">
										<p class="bold type-2">P {{ withComma(initialPayment) }}</p>
									</div
									><div class="width--60" v-if="stepData.paymentMethod == 1">
										<p class="z-margin-b">Total</p>
									</div
									><div class="width--40 align-r" v-if="stepData.paymentMethod == 1">
										<p class="bold">P {{ withComma(grandTotal) }}</p>
									</div>
									<div v-if="!stepData.isFullPayment" class="width--60">
										<p class="z-margin-b">Balance</p>
										<h6 class="font-2 type-red z-margin-b">Due 4 banking days before visit. {{ stepData.paymentMethod == 1 ? 'Inclusive of Paypal Charges.' : '' }}</h6>
									</div
									><div v-if="!stepData.isFullPayment" class="width--40 align-r">
										<p class="bold">P {{ withComma(nextPayment) }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="reservation-fr5__buttonCon align-r">
						<button class="button type-1" @click="$emit('stepFiveShow')"><span>Review Terms and Conditions</span><img src="images/images/icons/arrow.png"></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	
	import NumberMixin from 'Mixins/number.js';

	export default {
		props: {
			trailSelected: Object,
			stepData: Object,
			bankDetails: Array
		},

		data() {
			return {

			}
		},

		mixins: [ NumberMixin ],

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

			feePerHead() {
				// var feePerHead = parseFloat(this.trailSelected.weekday_fee);
				// var visitDate = moment(this.stepData.selectedDay+" "+this.stepData.selectedTime.time);
				// var is_weekend = (visitDate.day() === 6) || (visitDate.day() === 0);
				
				// if(is_weekend) {
				// 	feePerHead = parseFloat(this.trailSelected.weekend_fee);					
				// } 
				var guests = this.totalGuestFilledUp;
				var feePerHead = this.conservationalFee / guests;
				return feePerHead;
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

			halfPaymentAvailability() {
				var diffInDays = moment(this.stepData.selectedDay).startOf('day').diff(moment(Date.now()).startOf('day'), 'days');
				if(diffInDays > 10) {
					return true;
				}
				return false;
			}
		}
	}
</script>
