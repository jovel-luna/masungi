<template>
	<div>
		<div class="page-container">
			<form @submit.prevent="requestToVisit()">
			<div class="width--80 margin-a inlineBlock-parent">
				<div class="width--25">
					<label for="booking-type">Select Trail Experience</label>
					<select name="booking-type" class="select" v-model="item.trailSelected" required>
						<option v-for="(trail,key) in trails" v-if="trail.id != 2" :value="trail" :selected="key == 0">{{ trail.name }}</option>
					</select>
				</div
				><div class="width--25">
					<label for="booking-date">Date of Visit</label>
					<input class="input datapicker" ref="datepicker" type="text" name="booking-date" required placeholder="yyyy-mm-dd" @click="showDatePicker()" autocomplete="off">
				</div
				><div class="width--25">
					<label for="booking-guest">Number of Guests <br>
						<template v-if="showLabel">
							({{ item.trailSelected.age_group }} years old and up only)
						</template>
					</label>
					<input 
					ref="guests"
					class="number" 
					type="number" 
					name="booking-guest" 
					required 
					oninvalid="setCustomValidity('Kindly indicate the number of guests to proceed with the visit request')"
					oninput="setCustomValidity('')"
					:placeholder="minimumParticipantPlaceholder" 
					max="14" 
					v-model="item.total_guest">
				</div
				><div class="width--25">
					<button class="button type-1 no-icon" type="submit" ><span>Request to Visit</span></button>
				</div>
			</div>
			</form>
		</div>
	</div>
</template>
<script>
	import Swal from 'sweetalert2';

	export default {
		props: {
			trails: Array,

		},

		data() {
			return {
				item: {
					trailSelected: {},
				}
			}
		},

		watch: {
			'item.total_guest'(val) {
				if(val < this.item.trailSelected.minimum_participant && val != '') {
					Swal.fire({
						title: '<strong>Invalid no. of guests</strong>',
						icon: 'info',
						html:
						'<p>Should the number of guests be less than ' + this.item.trailSelected.minimum_participant  + ', this is doable however the conservation fees that will apply will be for the minimum of ' + this.item.trailSelected.minimum_participant  + ' guests. Kindly indicate ' + this.item.trailSelected.minimum_participant  + ' if you wish to proceed</p>',
						confirmButtonText: 'OKAY',
					})
				}
			}
		},

		computed: {
			dateSelected() {
				return this.$refs.datepicker.value;
			},

			minimumParticipantPlaceholder() {
				var text = 'Please select Trail'
				if(typeof this.item.trailSelected.minimum_participant != 'undefined') {
					text = 'Total Number of Guest (Min of '+this.item.trailSelected.minimum_participant+')';
				return text;

				}
			},
			showLabel() {
				return !_.isEmpty(this.item.trailSelected)
			},
		},

		mounted() {

		},

		methods: {
			showDatePicker() {
				$('.datapicker').datepicker('remove');
				var today = new Date();
				var disabled = [];
			    _.each(this.item.trailSelected.blocked_dates, (dt) => {
					if(dt.is_whole_day) {
						disabled.push(dt.date);
					}
				});
			    var $this = this;
				this.$nextTick(() => {
				$('.datapicker').datepicker({
					format: 'yyyy-mm-dd',
					startDate: '+'+$this.item.trailSelected.cut_off+'d',
					daysOfWeekDisabled: '1',
					datesDisabled: disabled,
					autoclose: true	

				}).datepicker("show");

			  }, 2000)
			},

			requestToVisit() {
				sessionStorage.setItem('trailSelected', JSON.stringify(this.item.trailSelected));
				sessionStorage.setItem('dateSelected', this.dateSelected);
				sessionStorage.setItem('numberOfGuests', this.item.total_guest);
				window.location.href = '/visitrequest';
			},
		}
	}
</script>
