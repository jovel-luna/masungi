<template>
		<section class="page-frame bg-white reservation-fr6">
			<div class="page-container">
				<div class="width--90 margin-a">
					<div class="reservation__title align-c">
						<h2>Terms and Conditions</h2>
					</div>
					<div class="width--100 margin-a bg-dullWhite">
						<div class="width--70 margin-a page-frame" v-html="termsAndCondition"></div>
					</div>
					<div class="reservation-fr6__buttonCon align-r">
						<button id="toRes-7" class="button type-1" @click="$emit('stepSixShow')"><span>Review Declarations</span><img src="images/images/icons/arrow.png"></button>
						<div>		
							<span v-if="scroll1"> PlEASE SCROLL DOWN </span>					
						</div>
					</div>
				</div>
			</div>
		</section>
</template>
<script>
	export default {
		props: {
			termsAndCondition: String,
			declarations: Array
		},

		watch: {
		},

		data() {
			return {
				viewDeclarations: false,
				scroll1: false,
				scroll2: false,
				selected: [],
				selectedAll: false
			}
		},

		methods: {
			selectAll() {
				this.selectedAll = !this.selectedAll;
				if(this.selectedAll) {
					_.each(this.declarations, (declaration) => {
						this.selected.push(declaration.id);
					})
				} else {
					this.selected = [];
				}
			}
		}
	}
</script>