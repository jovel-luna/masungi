<template>
	<div>
		<section ref="sample" class="page-frame bg-white reservation-fr7">
			<form @submit.prevent="$emit('stepSevenShow')" @click="">
			<div class="page-container">
				<div class="width--90 margin-a">
					<div class="reservation__title align-c">
						<h2>Declarations</h2>
					</div>
					
					<div class="width--100 margin-a">
						<div class="width--70 margin-a">
								<!-- {{-- COMPONENT_CHECKLIST --}} -->
								<div class="form-group" v-for="declaration, key in declarations" v-if="key == 0">

									<input type="checkbox" v-model="selected" :value="declaration.id" :id="declaration.id" :required="declaration.is_required == 1 ? true : false"><label :for="declaration.id" v-html="declaration.body"></label>
								</div>
								<div class="form-group">
									<input type="checkbox" id="declaration_age" required><label for="declaration_age">My Party and I are {{ $parent.trailSelected.age_group }} and above. All of the above guest information are accurate and complete.</label>
								</div>
								<div class="form-group" v-for="declaration, key in declarations" v-if="key != 0">
									<input type="checkbox" v-model="selected"  :value="declaration.id" :id="declaration.id" :required="declaration.is_required == 1 ? true : false"><label :for="declaration.id" v-html="declaration.body"></label>
								</div>
								<!-- {{-- END_COMPONENT_CHECKLIST --}} -->
						</div>
					</div>
					<div class="reservation-fr7__buttonCon align-r">
						<button id="toRes-8" class="button type-1" type="submit"><span>Review and Submit Request</span><img src="images/images/icons/arrow.png"></button>   
						<div>
							<span v-if="scroll2"> PlEASE SCROLL DOWN </span>
						</div>
					</div>
				</div>
			</div>
			</form>
		</section>
	</div>
</template>
<script>
	export default {
		props: {
			step: Number,
			termsAndCondition: String,
			declarations: Array
		},

		watch: {
			selected() {
				if(this.step > 6) {
					this.$emit('stepSix');
				}
			}
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