<template>
	<div>
		<div class="page-container">
			<div class="width--90 margin-a">
				<div class="reservation__title align-c">
					<h2>Kindly Fill out this Form</h2>
				</div>
				<div class="width--100 margin-a">
					<form @submit.prevent="nexStep()">
						<div class="reservation-fr4__genCon">
							<h5 style="font-size: 17px;">General Details:</h5>
							<p class="mb-4">Standard private trails are composed of a minimum of {{ trailSelected.minimum_participant }} guests and a maximum of {{ trailSelected.maximum_guest ? trailSelected.maximum_guest : 0  }} guests per trail schedule. Should the number be less than than {{ trailSelected.minimum_participant ? trailSelected.minimum_participant : 0 }}, this is doable however the conservation fees will remain at the minimum of {{ trailSelected.minimum_participant }}. Should the group be composed of more than {{ trailSelected.maximum_guest }} guests, kindly reach us through trail@masungigeoreserve.com to arrange a visit.</p>
							<p class="mb-4">All fields are required to be filled out unless indicated as optional. Once all fields have been filled out, the button for the next step shall appear.</p>
							<div class="form__list">
								<div class="width--30">
									<input class="input" v-model="stepData.visitPurpose" type="text" placeholder="Purpose of Visit (Optional)">
								</div>
								<template v-if="trailSelected.has_snack == 1">
									<div v-if="trailSelected.id !== 3" class="width--30">
										<select class="select" v-model="stepData.selectedAddOns" v-if="trailSelected.id !== 3">
											<option value="" disabled selected>Select Complimentary Meal</option>
											<!-- <option value="Select visit snack" disabled selected>Select Complimentary Light Snack</option> -->
											<option v-for="snack in trailSelected.snacks" :value="snack.name">{{ snack.name }}</option>
										</select>
									</div>
								</template>
								<div class="width--30">
									<input class="input" type="text" placeholder="Affiliation (Optional)" v-model="stepData.affiliation">
								</div>
								<div class="width--30">
									<label class="required guest none"><input v-model="stepData.numberOfGuests" :max="trailSelected.maximum_guest" :placeholder="minimumParticipantPlaceholder" pattern="\d*" required class="input guest" type="number" style="color: transparent;text-shadow: 0 0 0 black;"></label>
								</div>
							</div>
						</div>
						<div class="reservation-fr4__group1Con reservation-fr4__groupCon">
							<div class="reservation-fr4__grpLabelCon inlineBlock-parent">
								<div class="reservation-fr4__grpLblImgCon s-margin-r">
									<img src="images/images/icons/group.svg">
								</div>
								<h5 class="type-1 font-2 bold">GROUP 1</h5>
							</div>
							<div class="reservation-fr4__grp1LeadCon reservation-fr4__grpMemCon">
								<h2 class="font-3 type-1">Lead Details :</h2>
								<p class="m-margin-b">This guest will be part of the group and will be our main contact. He/she shall be responsible for relaying information and policies to the entire party.</p>
								<div class="reservation-fr4__grpListCon">
									<p>1.</p>
									<div class="form-group">
										<label class="required none"><input class="input" type="text" placeholder="First Name" v-model="stepData.main.first_name" @keypress="regexString()" required></label>
									</div>
									<div class="form-group">
										<label class="required none"><input class="input" type="text" placeholder="Last Name" @keypress="regexString()" v-model="stepData.main.last_name" required></label>
									</div>
									<div class="form-group">
										<label class="required none"><input class="input" type="text" placeholder="Contact Number" @keypress="mobileNumber()" v-model="stepData.main.contact_number" minlength="7" maxlength="19" required></label>
									</div>
									<date-picker v-model="stepData.main.birthday" :age="trailSelected.age_group"></date-picker>
									<!-- <div class="form-group">
										<input class="input datapicker" type="text" name="booking-date" placeholder="Birthday" v-model="stepData.main.birthday" required>
									</div> -->
									<div class="form-group">
										<label class="required none"><input class="input" type="email" placeholder="E-mail (required)" v-model="stepData.main.email" required ></label>
									</div>
									<div class="form-group">
										<label class="required none"><select class="select" required v-model="stepData.main.country" required >
											<option value="" disabled selected>Country</option>
											<option v-for="country in countries" :value="country.citizenship">{{ country.name }}</option>
										</select></label>
									</div>
									<div class="form-group-cancel"></div>
								</div>
							</div>
							<div v-if="trailSelected.minimum_participant > 1" class="reservation-fr4__grpMemCon">
								<h2 class="font-3 type-1">Other Guest Details :</h2>
								<p class="m-margin-b">Kindly indicate the details of the other guests. If number of guests is less than {{ trailSelected.minimum_participant }}, kindly click the "x" button to indicate that no other guests will be taking these slots</p>
								<!-- {{-- COMPONENT_MEMBER_LIST --}} -->
								<template v-for="(guest,key) in guestsGroupOne">
									<GuestGroupOne :count="key" :countries="countries" @disabledGuestInGroupOne="disabledGuestInGroupOne(...arguments)" :total-guests="stepData.numberOfGuests"></GuestGroupOne>
								</template>
								<!-- {{-- END_COMPONENT_MEMBER_LIST --}} -->
							</div>
						</div>
						<!-- Uncomment if group 2 will be required -->
						<!-- <div class="reservation-fr4__groupCon" v-if="guestsGroupTwo.length">
							<div class="reservation-fr4__grpLabelCon inlineBlock-parent">
								<div class="reservation-fr4__grpLblImgCon s-margin-r">
									<img src="images/images/icons/group.svg">
								</div>
								<h5 class="type-1 font-2 bold">GROUP 2</h5>
							</div>
							<div class="reservation-fr4__grpMemCon">
								<template v-for="(guest,key) in guestsGroupTwo">
									<GuestGroupTwo :count="key" :group-one-count="guestsGroupOne.length" :countries="countries" @disabledGuestInGroupOne="disabledGuestInGroupOne(...arguments)"></GuestGroupTwo>
								</template>
							</div>
						</div> -->
						<div class="reservation-fr4__grpNextCon align-r" v-if="isCompleteData">
							<button class="button type-1" type="submit"><span>Choose Payment Method</span><img src="images/images/icons/arrow.png"></button>
						</div>
                                               <div class="reservation-fr4__grpNextCon align-r" v-else>
                                                        <button class="button" style="background: #c9c3a6" disabled><span>Choose Payment Method</span><img src="images/images/icons/arrow.png"></button>
                                                </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>
<script>

	import GuestGroupOne from '../groups/GuestGroupOne.vue';
	import GuestGroupTwo from '../groups/GuestGroupTwo.vue';
	import CDatePicker from '../customdatepicker/CDatepicker.vue';
	import RegexValidation from 'Mixins/regex.js';
	import Swal from 'sweetalert2';

	export default {
		props: {
			snacks: Array,
			countries: Array,
			stepData: Object,
			trailSelected: Object
		},

		mixins: [ RegexValidation ],

		components: {
			"date-picker": CDatePicker,
			GuestGroupOne,
			GuestGroupTwo,
			Swal
		},

		data() {
			return {
				guestsGroupOne: [],
				guestsGroupTwo: [],
			}
		},

		computed: {
			minimumParticipantPlaceholder() {
				var text = 'Minimum of Number of Guest is '+this.trailSelected.minimum_participant;
				return text;
			},

			isCompleteData() {
				var bool = false;

				if(this.stepData.main.first_name !== null && this.stepData.main.last_name !== null &&
					this.stepData.main.email !== null && this.stepData.main.birthday !== null &&
					this.stepData.main.contact_number !== null && this.stepData.main.country !== 'selected' &&
					this.stepData.main.first_name !== '' && this.stepData.main.last_name !== '' &&
					this.stepData.main.email !== '' && this.stepData.main.birthday !== '' &&
					this.stepData.main.contact_number !== '' && this.stepData.main.contact_number.length <= 19 &&
					this.stepData.main.country !== 'selected') {
					//  &&this.stepData.affiliation != '' && this.stepData.visitPurpose != ''
					console.log(this.trailSelected.has_snack)
					if(this.trailSelected.has_snack > 0) {
						console.log('has snack false')
						if(this.stepData.selectedAddOns !== null) {
							bool = true;
						} else {
							bool = false;
							console.log('select addons false')
						}
					} else {
						bool = true;
					}
				}
				
				// Iterate over each guest and check if all fields values are complete
				 _.each(this.$children, (child, key) => {
					if(key !== 0) {
						if(!child.$data.guest.disabled) {
							if(child.$data.guest.first_name !== null && child.$data.guest.last_name !== null &&
								child.$data.guest.email !== null && child.$data.guest.birthday !== null &&
								child.$data.guest.contact_number !== null && child.$data.guest.country !== 'selected' &&
								child.$data.guest.first_name !== '' && child.$data.guest.last_name !== '' &&
								child.$data.guest.email !== '' && child.$data.guest.birthday !== '' &&
								child.$data.guest.contact_number !== '' && child.$data.guest.contact_number.length <= 19 &&
								child.$data.guest.country !== 'selected') {
								//  &&this.stepData.affiliation != '' && this.stepData.visitPurpose != ''
								bool = true;
							} else {
								bool = false;
								console.log('child false')
							}
						}
					}
				})

				return bool;
			}
		},

		mounted() {
			this.groups();

			setTimeout(function(){
				$("select.select").val("");
			}, 300);
		},

		watch: {
			isCompleteData(newValue) {
				if(newValue == false) {
					this.$emit('returnToStepThree');	
				}
			},

			'stepData.numberOfGuests':function(newValue, oldValue) {
				console.log(oldValue,newValue);
				if(parseInt(newValue) > this.trailSelected.maximum_guest) {
					this.stepData.numberOfGuests = this.trailSelected.maximum_guest;
					return;
				} else if (newValue === "" || newValue == 1) {
					return;
				} else if (parseInt(newValue) < this.trailSelected.minimum_participant) {
					this.stepData.numberOfGuests = this.trailSelected.minimum_participant;
					return;
				}
				var data = {
					first_name: null,
					last_name: null,
					contact_number: null,
					birthday: null,
					email: null,
					country: null,
					main: 0
				};

				if(parseInt(newValue) > parseInt(oldValue)) {
					if(parseInt(newValue) >= this.trailSelected.minimum_participant) {
						if(parseInt(newValue) <= this.trailSelected.maximum_guest) {
							/* Add new field if the number of guests field value is lower than the maximum guest count per visit */
							while(parseInt(newValue) - 1 > this.guestsGroupOne.length) {
							    this.guestsGroupOne.push(data);
							}
						}
					}

				} else if(parseInt(newValue) >= this.trailSelected.minimum_participant) {
					/* Group two was asked by the client to be removed*/
					/*if(this.guestsGroupTwo.length) {
						var newVal = parseInt(oldValue) - parseInt(newValue);
						for(var i = 1; i <= newVal; i++) {
							this.guestsGroupTwo.pop();
						}
					}
					 else {*/

						if (this.guestsGroupOne.length < parseInt(newValue)) {
						        while(parseInt(newValue) - 1 > this.guestsGroupOne.length) {
                                                            this.guestsGroupOne.push(data);
                                                        }
						} else {

							while(parseInt(newValue) - 1 < this.guestsGroupOne.length) {
						   	     this.guestsGroupOne.pop();
							}
						}
					// }
				}

				this.$nextTick(() => {
				    this.prepareGuests();
				});

				

				if(parseInt(newValue) < this.trailSelected.minimum_participant && newValue !== '') {
					Swal.fire({
						title: '<strong>No. of guests below minimum</strong>',
						icon: 'info',
						html:
						'<p>Should the number of guests be less than ' + this.trailSelected.minimum_participant  + ', this is doable however the conservation fees that will apply will be for the minimum of ' + this.trailSelected.minimum_participant  + ' guests.</p>',
						confirmButtonText: 'OKAY',
					})
				}
			},
		},

		methods: {

			groups() {
				var data = {
					first_name: null,
					last_name: null,
					contact_number: null,
					birthday: null,
					email: null,
					country: 'selected',
					main: 0
				};

				var numberOfGuests = this.stepData.numberOfGuests;
				for(var i = 1; i < this.stepData.numberOfGuests; i++) {
					if(i < this.trailSelected.maximum_guest) {

						this.guestsGroupOne.push(data);
					}

					//if(i <= this.trailSelected.minimum_participant) {
					//	this.guestsGroupOne.push(data);
					//} else if(i >= this.trailSelected.minimum_participant){
				        //	this.guestsGroupTwo.push(data);
					//}

					//this.stepData.guests.push(data);
				}
				// console.log(this.stepData.numberOfGuests);
				//if(numberOfGuests > 1) {
			//		var left = this.stepData.numberOfGuests - (numberOfGuests - 1);
			//		for(var i = 1; i < left; i++) {
			//			this.guestsGroupOne.push(data);
			//			this.stepData.guests.push(data);
			//		}
			//	}

			},


			count(key) {
				return key + 2;
			},

			removeGuestsInGroupTwo(key) {
				this.stepData.guests.splice(key, 1);
				this.guestsGroupTwo.splice(key, 1);
				// var totalGuests = parseInt(this.stepData.numberOfGuests) - 1;
				// this.stepData.numberOfGuests = totalGuests;
			},

			disabledGuestInGroupOne(key) {
				this.stepData.guests[key].disabled = true;
				if(this.stepData.guests[key].disabled == true) {
					this.stepData.guests[key].disabled = false;
				}
				// this.guestsGroupOne.splice(key, 1);
			},

			disabledGuestInGroupTwo(key) {
				this.stepData.guests[key].disabled = true;
				// this.guestsGroupOne.splice(key, 1);
			},

			nexStep() {
				this.prepareGuests();
				this.$emit('stepFourShow')
			},

			disabledPress(event) {
		      	event.preventDefault();
			},

			prepareGuests() {
				this.stepData.guests = [];
                                _.each(this.$children, (child, key) => {
                                        if(key != 0) {
                                                this.stepData.guests.push(child.$data.guest);
                                        }
                                })
			}
		}
	}
</script>
