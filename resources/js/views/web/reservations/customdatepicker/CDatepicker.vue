<template>
	<div class="form-group">
		<label class="required none"><input :disabled="disabled" class="input datapicker" ref="elem" type="text" name="booking-date" placeholder="Birthday" required></label>
	</div>
</template>

<script type="text/javascript">
/* Flatpickr Documentation: https://flatpickr.js.org/options/ */
import flatpickr from 'flatpickr';
// window.flatpickr = flatpickr;
import 'flatpickr/dist/flatpickr.css';

export default {
	watch: {
		value(value, oldValue) {
			if (!oldValue) {
				this.elem.setDate(value);
			}

			if(!value) {
				this.elem.setDate(value);
			}
		},
	},

	computed: {
		maxDate() {
			var age = this.age;
			var years = moment().subtract(age, "years").format("YYYY-MM-DD");
			return years;
		}
	},

	mounted() {
		this.setup();
	},

	methods: {
		setup() {
			let options = this.getOptions();
			var $this = this;
			this.elem = flatpickr(this.$refs.elem, options);
		},


		getOptions() {
			let $this = this;
			let options = {
				disableMobile: true, 
				maxDate: this.maxDate,
				onChange(selectedDates, dateStr, instance) {
					let date = dateStr;

					$this.$emit('change', date);
				},
			};

			return options;
		},
	},

	props: {
		name: String,
		note: String,
		value: {},
		disabled: {
			default: false,
			type: Boolean,
		},
		age: Number
	},

	data() {
		return {
			//
		}
	},

	model: {
        prop: 'value',
        event: 'change', 
    },

}
</script>