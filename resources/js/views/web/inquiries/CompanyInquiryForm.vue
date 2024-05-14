<template>
	<div>
		<form @submit.prevent="processForm">
			<div class="inlineBlock-parent">
				<div class="width--50 align-t">
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Name of Company/Organization *" v-model="item.name">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Name of Lead Contact *" v-model="item.leadcontact">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Position of Lead Contact *" v-model="item.position">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="E-mail Address *" v-model="item.email">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="number" placeholder="Contact Number (09xxxxxxxxx) *" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==11) return false;" v-model="item.contact_number">
					</div>
				</div
				><div class="width--50 align-t">
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Purpose of Visit *" v-model="item.purpose">
					</div>
					<div class="form-group m-margin-b">
						<input class="input date" type="text" placeholder="Preferred Date *" v-model="item.preferreddate">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="number" placeholder="Number Participants *" v-model="item.participants">
					</div>
					<div class="form-group m-margin-b">
						<textarea class="textarea" placeholder="Special Requests or Concerns (optional)" v-model="item.concerns"></textarea>
					</div>
				</div>
			</div>
			<div class="align-c m-margin-t fadeIn">
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
					leadcontact: this.item.leadcontact,
					name: this.item.name,
					email: this.item.email,
					position: this.item.position,
					contact_number: this.item.contact_number,
					purpose: this.item.purpose,
					preferreddate: this.item.preferreddate,
					participants: this.item.participants,
					concerns: this.item.concerns,
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