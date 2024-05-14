export default {
	methods: {
		round(value) {
			return Math.round(value);
		},

		toFloat(value) {
			return parseFloat(value);
		},

		toMoney(value, prefix = '₱') {
			if (!value) { return; }
			return prefix + ' ' + (parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')).toString();
		},

		withComma(value, _default=2) {
            return parseFloat(value).toFixed(_default).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
	}
}