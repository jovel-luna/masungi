<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header> Trail Schedule </template>
			
			<div class="row">
				<div class="custom-control custom-switch ml-3">
					<input
					v-model="item.is_special_event"
					name="is_special_event" :checked="item.is_special_event" type="checkbox" class="custom-control-input" id="is_special_event" @change="specialEventsToggle()">
					<label class="custom-control-label" for="is_special_event">Is special event?</label>
				</div>
			</div>

			<div class="row">
				<div class="custom-control custom-switch ml-3">
					<input
					v-model="item.has_snack"
					name="has_snack" type="checkbox" class="custom-control-input" id="has_snack">
					<label class="custom-control-label" for="has_snack">Complimentary Snack included?</label>
				</div>
			</div>

			<br>

			<div class="row" v-show="item.showDates">
				<date-picker
				v-model="item.date_to_show"
				class="form-group col-sm-12 col-md-6"
				label="Date of Special Event"
				name="date_to_show"
				date-format="Y-m-d"
				placeholder="Choose a date"
				></date-picker>

				<date-picker
				v-model="item.expiration_date"
				class="form-group col-sm-12 col-md-6"
				label="Expiration Date of Special Event"
				name="expiration_date"
				date-format="Y-m-d"
				placeholder="Choose a date"
				></date-picker>
			</div>


			<div class="row">

				<selector class="col-sm-12 col-md-4"
				v-model="item.experience_id"
				name="experience_id"
				label="Experience"
				:items="experiences"
				item-value="id"
				item-text="name"
				empty-text="None"
				placeholder="Please select a Experience"
				></selector>
				
				<div class="form-group col-sm-12 col-md-4">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Estimated Duration</label>
					<input v-model="item.estimated_duration" name="estimated_duration" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Terrain</label>
					<input v-model="item.terrain" name="terrain" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Recommended For</label>
					<input v-model="item.recommended_for" name="recommended_for" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Minimum Participant</label>
					<input v-model="item.minimum_participant" name="minimum_participant" type="number" min="1" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Maximum Guest Count</label>
					<input v-model="item.maximum_guest" name="maximum_guest" type="number" :min="item.minimum_participant" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Maximum Capacity</label>
					<input v-model="item.capacity_per_day" :min="item.maximum_guest" name="capacity_per_day" type="number" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Age Group</label>
					<input v-model="item.age_group" name="age_group" type="number" min="1" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Cutoff Days</label>
					<input v-model="item.cut_off" name="cut_off" type="number" min="1" class="form-control">
				</div>
				<!-- <div class="form-group col-sm-12 col-md-4">
					<label>Fee per guest</label>
					<input v-model="item.fee_per_guest" name="fee_per_guest" min="0" type="number" class="form-control">
				</div> -->							
			</div>

			<div class="row">
				<div class="form-group col-sm-12 col-md-4">
					<label>Weekday Fee</label>
					<input v-model="item.weekday_fee" name="weekday_fee" min="0" type="number" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Weekend Fee</label>
					<input v-model="item.weekend_fee" name="weekend_fee" min="0" type="number" class="form-control">
				</div>	

				<!-- <div class="form-group col-sm-12 col-md-4">
					<label>Paypal Charges <small>(Note: This will work only if the transaction is paypal)</small></label>
					<input v-model="item.paypal_charges" name="paypal_charges" min="0" type="number" class="form-control">
				</div>	 -->
			</div>
			
			<div class="row">

				<text-editor
				v-model="item.description"
				class="col-sm-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.overview"
				class="col-sm-12"
				label="Overview"
				name="overview"
				row="5"
				></text-editor>
	
				<text-editor
				v-model="item.characteristic"
				class="col-sm-12"
				label="Area Characteristic"
				name="characteristic"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.ideal_for"
				class="col-sm-12"
				label="Ideal For"
				name="ideal_for"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.inclusions"
				class="col-sm-12"
				label="Inclusions"
				name="inclusions"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.good_to_know"
				class="col-sm-12"
				label="Good To Know"
				name="good_to_know"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.visit_request_process"
				class="col-sm-12"
				label="Visit Request Process"
				name="visit_request_process"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.terms_and_condition"
				class="col-sm-12"
				label="Terms and condition (upon reservation)"
				name="terms_and_condition"
				row="5"
				></text-editor>
			</div>

			<div class="row">
				<image-picker
					:value="item.path"
					class="form-group col-sm-12 col-md-12 mt-2"
	                label="Image"
	                name="image_path"
	                placeholder="Choose a File"
					></image-picker>
			</div>


			<template v-slot:footer>
				<action-button type="submit" :disabled="loading" class="btn-primary">Save Changes</action-button>
            
                <action-button
                v-if="item.archiveUrl && item.restoreUrl"
                color="btn-danger"
                alt-color="btn-warning"
                :action-url="item.archiveUrl"
                :alt-action-url="item.restoreUrl"
                label="Archive"
                alt-label="Restore"
                :show-alt="item.deleted_at"
                confirm-dialog
                title="Archive Item"
                alt-title="Restore Item"
                :message="'Are you sure you want to archive Experience #' + item.id + '?'"
                :alt-message="'Are you sure you want to restore Experience #' + item.id + '?'"
                :disabled="loading"
                @load="load"
                @success="fetch"
                @error="fetch"
                ></action-button>
			</template>
		</card>

		<loader :loading="loading"></loader>
		
	</form-request>
</template>

<script type="text/javascript">
import { EventBus }from '../../../EventBus.js';
import CrudMixin from '../../../mixins/crud.js';

import ActionButton from '../../../components/buttons/ActionButton.vue';
import Select from '../../../components/inputs/Select.vue';
import ImagePicker from '../../../components/inputs/ImagePicker.vue';
import TextEditor from '../../../components/inputs/TextEditor.vue';
import Datepicker from '../../../components/datepickers/Datepicker.vue';
import TimePicker from '../../../components/timepickers/Timepicker.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.experiences = data.experiences ? data.experiences : this.experiences;
		},

		specialEventsToggle() {
			this.item.showDates = !this.item.showDates;
		}
	},

	data() {
		return {
			item: [],
			experiences: [],
		}
	},

	components: {
		'action-button': ActionButton,
		'selector': Select,
		'image-picker': ImagePicker,
		'text-editor': TextEditor,
		'date-picker': Datepicker,
		'time-picker': TimePicker,
	},

	mixins: [ CrudMixin ],
}
</script>