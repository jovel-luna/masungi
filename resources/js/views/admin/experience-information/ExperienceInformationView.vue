<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header> Experience Information </template>

			<div class="row">
				
				<selector class="col-sm-12 col-md-6"
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
					<label>Duration</label>
					<input v-model="item.duration" name="duration" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Terrain</label>
					<input v-model="item.terrain" name="terrain" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-4">
					<label>Age Group</label>
					<input v-model="item.age_group" name="age_group" type="text" class="form-control">
				</div>

				<text-editor
				v-model="item.conservation_fees"
				class="col-sm-12"
				label="Conservation Fee"
				name="conservation_fees"
				row="3"
				></text-editor>

				<text-editor
				v-model="item.overview"
				class="col-sm-12"
				label="Overview"
				name="overview"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.trail_characteristics"
				class="col-sm-12"
				label="Area Characteristics"
				name="area_characteristics"
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
				v-model="item.conservation_fee_detail"
				class="col-sm-12"
				label="Conservation Fee Detail"
				name="conservation_fee_detail"
				row="5"
				></text-editor>

				<text-editor
				v-model="item.visit_request"
				class="col-sm-12"
				label="Visit Request"
				name="visit_request"
				row="5"
				></text-editor>				
				
				<image-picker
				:value="images"
				class="form-group col-sm-12 col-md-4"
	            label="Images"
	            name="images[]"
	            placeholder="Choose Files"
	            multiple
	            :sort-url="sortUrl"
	            :remove-url="item.removeImageUrl"
	            @remove="fetch"
	            max="2"
	            min="1"
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
                :message="'Are you sure you want to archive Destination #' + item.id + '?'"
                :alt-message="'Are you sure you want to restore Destination #' + item.id + '?'"
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
			this.images = data.images ? data.images : this.images;
			this.experiences = data.experiences ? data.experiences : this.experiences;

		},
	},

	data() {
		return {
			item: [],
			images: [],
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