<template>
	<div>
		<form @submit.prevent="processForm">
			<div class="inlineBlock-parent">
				<div class="width--50 align-t">
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="First Name *" v-model="item.firstname">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Last Name *" v-model="item.lastname">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Contact Number (09xxxxxxxxx)*" v-model="item.contact_number" @keypress="regexNumber()" maxlength="11">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="E-mail Address *" v-model="item.email">
					</div>
				</div
				><div class="width--50 align-t">
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Affliation *" v-model="item.affliation">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Nationality *" v-model="item.nationality">
					</div>
					<div class="form-group m-margin-b">
						<textarea class="textarea" placeholder="Message *" v-model="item.message"></textarea>
					</div>
				</div>
			</div>
			<div class="align-c m-margin-t">
				<button type="submit" class="button type-1"><span>Submit</span><img src="images/images/icons/arrow.png"></button>
			</div>
		</form>
		<loading :active.sync="isLoading" 
		        :is-full-page="fullPage"></loading>
	</div>
</template>
<script>
    import Loading from 'vue-loading-overlay';
    import ErrorResponse from 'Mixins/errorResponse';
    import 'vue-loading-overlay/dist/vue-loading.css'; 
	import RegexValidation from 'Mixins/regex.js';

	export default {
		props: {
			storeUrl: String
		},

		data() {
			return {
				item: {},
				isLoading: false,
                fullPage: true
			}
		},

		mixins: [ ErrorResponse, RegexValidation ],

		components: {
            Loading
		},

		methods: {
			processForm() {
				this.isLoading = true;
				var data = {
					firstname: this.item.firstname,
					lastname: this.item.lastname,
					email: this.item.email,
					contact_number: this.item.contact_number,
					email: this.item.email,
					affliation: this.item.affliation,
					nationality: this.item.nationality,
					message: this.item.message,
				}
				axios.post(this.storeUrl, data)
					.then(response => {
						this.isLoading = false;
						this.item = {};
						swal.fire("Inquiry Sent", "Thank you! Your inquiry has been sent. Kindly expect a response between 1-3 days.", "success");
					}).catch(errors => {
						this.isLoading = false;
						var message = this.parseResponse(errors, 'error');
						swal.fire("Ooops", message , "error");
					})
			}
		}
	}
</script>