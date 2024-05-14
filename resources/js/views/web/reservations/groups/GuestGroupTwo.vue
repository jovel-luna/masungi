<template>
	<div class="reservation-fr4__grpListCon">
		<p>{{ numberCount }}.</p>
		<div class="form-group">
			<label class="required none"><input class="input" type="text" placeholder="First Name" v-model="guest.first_name"  @keypress="regexString()" required :disabled="guest.disabled" :class="guest.disabled ? 'disable_input' : null"></label>
		</div>
		<div class="form-group">
			<label class="required none"><input class="input" type="text" placeholder="Last Name" v-model="guest.last_name" @keypress="regexString()" required :disabled="guest.disabled" :class="guest.disabled ? 'disable_input' : null"></label>
		</div>
		<div class="form-group">
			<label class="required none"><input class="input" type="text" maxlength="11" placeholder="Contact Number (09xxxxxxxxx)" v-model="guest.contact_number" @keypress="regexNumber()" required :disabled="guest.disabled" :class="guest.disabled ? 'disable_input' : null"></label>
		</div>
		<!-- <date-picker v-model="guest.birthday" :disabled="guest.disabled" :class="guest.disabled ? 'disable_input' : null"></date-picker> -->
		<date-picker v-model="guest.birthday" :disabled="guest.disabled" :age="ageGroup" :class="guest.disabled ? 'disable_input' : null"></date-picker>
<!-- 		<div class="form-group">
			<input class="input datapicker" type="text" name="booking-date" placeholder="Birthday" v-model="guest.birthday" :disabled="guest.disabled" :class="guest.disabled ? 'disable_input' : null" required>
		</div> -->
		<div class="form-group">
			<label class="required none"><input class="input" type="email" placeholder="E-mail (required)" v-model="guest.email" required :disabled="guest.disabled" :class="guest.disabled ? 'disable_input' : null"></label>
		</div>
		<div class="form-group">
			<label class="required none"><select class="select" v-model="guest.country" required :disabled="guest.disabled" :class="guest.disabled ? 'disable_input' : null">
				<option value="" disabled selected>Country</option>
				<option v-for="country in countries" :value="country.citizenship">{{ country.name }}</option>
			</select></label>
		</div>
		<div class="form-group-cancel" @click="$emit('disabledGuestInGroupTwo', count); disabledGuests()">
			<img :src="guest.disabled ? button.cbutton : button.xbutton" :title="toggle">
		</div>
	</div>
</template>
<script>
	import RegexValidation from 'Mixins/regex.js';
	import CDatePicker from '../customdatepicker/CDatepicker.vue';

	export default {
		props: {
			count: Number,
			groupOneCount: Number,
			countries: Array
		},

		mixins: [ RegexValidation ],

		components: {
			"date-picker": CDatePicker,

		},
		
		computed: {
			ageGroup() {
				return this.$parent.trailSelected.age_group;
			}
		},

		data() {
			return {
				guest: {
					first_name: null,
					last_name: null,
					contact_number: null,
					birthday: null,
					email: null,
					country: 'Filipino',
					disabled: false,
					main: 0,
					class: null

				},
				toggle: 'Disable input to this guest.',
				button: {
					xbutton: "images/images/icons/x-button.svg",
					cbutton: "images/images/icons/check-mark.png",
				}
			}
		},

		computed: {
			numberCount() {
				var count = this.count + 2;
				var groupOne = this.groupOneCount;
				var response = count + groupOne;
				
				return response;
			}
		},

		mounted() {
			// this.$nextTick(()=> {
			// 	flatpickr('.datapicker', {disableMobile: true, maxDate: new Date().fp_incr(-4745)});
			// }, 1000)
		},

		methods: {
			disabledGuests() {
				if(this.guest.disabled) {
					this.guest = {
						first_name: null,
						last_name: null,
						contact_number: null,
						birthday: null,
						email: null,
						country: 'Filipino',
						disabled: false,
						main: 0,
						class: null
					};
					this.toggle = 'Disable input to this guest.';
				}else {
					this.guest = {disabled:true};
					this.toggle = 'Enable input to this guest.';
				}
			}
		}

	}
</script>