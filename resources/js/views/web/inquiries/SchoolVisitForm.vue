<template>
	<div>
		<form @submit.prevent="processForm">
			<div class="inlineBlock-parent">
				<div class="width--50 align-t">
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="School *" v-model="item.school">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Full Name *" v-model="item.leadcontact">
					</div>
					<div class="form-group m-margin-b">
						<input class="input" type="text" placeholder="Position *" v-model="item.position">
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
						<input class="input" type="text" placeholder="Year Level *" v-model="item.yearlevel">
					</div>
					<div class="form-group m-margin-b inlineBlock-parent">
						<div class="width--50">
							<input class="input date" type="text" placeholder="Preferred Date *" v-model="item.preferreddate">
						</div
						><div class="width--50">
							<input class="input time" type="text" placeholder="Preferred Time *" v-model="item.preferredtime">
						</div
						>
					</div>
					<div class="form-group m-margin-b">
						<select class="select" required v-model="item.trail_id">
							<option value="" disabled selected value="0">Select Trail  *</option>
							<option v-for="trail in trails" :value="trail.id">{{ trail.name }}</option>
						</select>
					</div>
					<div class="form-group m-margin-b">
						<textarea class="textarea" placeholder="Special Requests or Concerns (optional)" v-model="item.message"></textarea>
					</div>
				</div>
			</div>
			<div class="align-c m-margin-t">
				<button class="button type-1 fadeIn"><span>Submit</span><img src="images/images/icons/arrow.png"></button>
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
			storeUrl: String,
			trails: Array
		},

		data() {
			return {
				item: {
					trail_id: 0,
					contact_number:"",
					email: null,
					leadcontact: null,
					message: null,
					position: null,
					preferreddate: null,
					preferredtime: null,
					school: null,
					yearlevel: null
				},
				isLoading: false,
                fullPage: true, 
                timeOptions: {
                	enableTime: true,
                	noCalendar: true,
                }
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
			$('.time').flatpickr(this.timeOptions);
		},

		methods: {
			processForm() {
				this.isLoading = true;
				var data = {
					leadcontact: this.item.leadcontact,
					email: this.item.email,
					position: this.item.position,
					contact_number: this.item.contact_number,
					school: this.item.school,
					yearlevel: this.item.yearlevel,
					preferredtime: this.item.preferredtime,
					preferreddate: this.item.preferreddate,
					trail_id: this.item.trail_id,
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