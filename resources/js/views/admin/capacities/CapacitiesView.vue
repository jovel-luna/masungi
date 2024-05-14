<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header>Capacity Information</template>
			<div class="row">
				<selector class="col-sm-4"
				v-model="item.trail_id"
				name="trail_id"
				label="Trail"
				:items="trails"
				item-value="id"
				item-text="name"
				placeholder="Select Trail"
				@change="trailChanged()"
				></selector>
				<div class="form-group col-sm-12 col-md-4">
					<label>Total Capacity</label>
					<input v-model="item.capacity" name="capacity" type="number" min="1" class="form-control">
				</div>
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
                :message="'Are you sure you want to archive FAQ #' + item.id + '?'"
                :alt-message="'Are you sure you want to restore FAQ #' + item.id + '?'"
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

	computed: {

	},

	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.trails = data.trails ? data.trails : this.trails;
		},

		trailChanged() {
			var id = this.item.trail_id;
			var trails = this.trails;

			_.each(trails, (trail) => {
				console.log(trail, id)
				if(id == trail.id) {
					this.capacity = parseInt(trail.experience.capacity);
				}
			});
		}
	},

	data() {
		return {
			item: [],
			trails: [],
			capacity: 0
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
