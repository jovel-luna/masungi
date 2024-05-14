<template>
	<div>
		<form @submit.prevent="processForm">
			<div class="inlineBlock-parent">
				<div class="width--50 align-t">
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Full Name *" v-model="item.fullname">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="E-mail Address *" v-model="item.email">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Contact Number *" v-model="item.contact_number">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Type of Event *" v-model="item.eventtype">
					</div>
				</div
				><div class="width--50 align-t">
					<div class="form-group m-margin-b">
						<input class="input date" type="text" placeholder="Date of Event *" v-model="item.date">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="number" min="1" placeholder="Number of Guests *" v-model="item.guestsnumber">
					</div>
					<div class="form-group m-margin-b">
						<textarea class="textarea" placeholder="Message (optional)" v-model="item.message"></textarea>
					</div>
				</div>
			</div>
			<div class="align-c m-margin-t">
				<button type="submit" class="button type-1 fadeIn"><span>Submit</span><img src="images/images/icons/arrow.png"></button>
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

		mixins: [ ErrorResponse ],

		components: {
            Loading
		},

		mounted() {
			$('.date').flatpickr({
				minDate: 'today'
			});
		},

		methods: {
			processForm() {
				this.isLoading = true;
				var data = {
					fullname: this.item.fullname,
					email: this.item.email,
					contact_number: this.item.contact_number,
					date: this.item.date,
					eventtype: this.item.eventtype,
					guestsnumber: this.item.guestsnumber,
					message: this.item.message,
				}
				axios.post(this.storeUrl, data)
					.then(response => {
						this.isLoading = false;
						this.item = {};
						swal.fire("Inquiry Sent", "Thank you! Your message has been sent. Our Partnerships Officer will get back to you as soon as possible.", "success");
					}).catch(errors => {
						this.isLoading = false;
						var message = this.parseResponse(errors, 'error');
						swal.fire("Ooops", message , "error");
					})
			}
		}
	}
</script>
