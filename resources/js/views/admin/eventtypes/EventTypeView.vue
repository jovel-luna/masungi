<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header> Event Type </template>

			<div class="row">
				
				<selector class="col-sm-12 col-md-6"
				v-model="item.event_id"
				name="event_id"
				label="Event"
				:items="events"
				item-value="id"
				item-text="name"
				empty-text="None"
				placeholder="Please select a Event"
				></selector>

				<div class="col-sm-12 col-md-6">
					<label> Event Name </label>					
					<input v-model="item.name" name="name" type="text" class="form-control">

				</div>

				<div class="col-sm-12 col-md-6">
					<label> Event Activity </label>					
					<input v-model="item.activity" name="activity" type="text" class="form-control">

				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>Duration</label>
					<input v-model="item.duration" name="duration" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>Age Group</label>
					<input v-model="item.age_group" name="age_group" type="text" class="form-control">
				</div>

				<div class="form-group col-sm-12 col-md-6">
					<label>Participants/Group</label>
					<input v-model="item.participants" name="participants" type="text" class="form-control">
				</div>


				<text-editor
				v-model="item.conservation_fees"
				class="col-sm-12"
				label="Conservation Fee"
				name="conservation_fees"
				row="2"
				></text-editor>	

				<text-editor
				v-model="item.conservation_info"
				class="col-sm-12"
				label="Conservation Info"
				name="conservation_info"
				row="3"
				></text-editor>	

				<text-editor
				v-model="item.features"
				class="col-sm-12"
				label="Features"
				name="features"
				row="3"
				></text-editor>	

				<text-editor
				v-model="item.description"
				class="col-sm-12"
				label="Description"
				name="description"
				row="3"
				></text-editor>			
			
				
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
			this.events = data.events ? data.events : this.events;
			this.types = data.types ? data.types : this.types;
		},
	},

	data() {
		return {
			item: [],
			events: [],
			types: [],
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