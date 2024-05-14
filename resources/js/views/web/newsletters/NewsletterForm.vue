<template>
	<div>
			<div class="ftr__subsCon">
				<h6 class="type-4">Subscribe to our Newsletter</h6>
				<form @submit.prevent="processForm">
					<div class="ftr__input">
						<input class="input" type="text" placeholder="Enter e-mail here" v-model="item.email">
						<button type="submit"><i class="fas fa-paper-plane"></i></button>
					</div>
					<div class="ftr__input inlineBlock-parent">
						<input v-model="item.agreement" type="checkbox" required>
						<label class="type-4">I would like to receive updates and be part of the mailing list of Masungi Georeserve</label>
					</div>
				</form>
			</div>
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

		methods: {
			processForm() {
				this.isLoading = true;
				
				var data = {
					email: this.item.email,
					agreement: this.item.agreement,
				}

				axios.post(this.storeUrl, data)
					.then(response => {
						this.isLoading = false;
						this.item = {};
						swal.fire("Email Sent", "News and Updates on Masungi Georeserve will be sent to your email. Thank you!", "success");
					}).catch(errors => {
						this.isLoading = false;
						var message = this.parseResponse(errors, 'error');
						swal.fire("Ooops", message , "error");
					})
			}
		}
	}
</script>
