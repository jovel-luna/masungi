<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header>Trail Experience </template>

			<div class="row">
				<div class="form-group col-sm-12 col-md-6">
					<label> Trail Experience  </label>
					<input v-model="item.name" name="name" type="text" class="form-control">
				</div>

				<time-picker
				v-model="item.operating_hours"
				class="form-group col-sm-12 col-md-3 time"
				label="Operating Hours Start"
				name="operating_hours"
				placeholder="Choose time slot"
				></time-picker>

				<time-picker
				v-model="item.operating_hours_end"
				class="form-group col-sm-12 col-md-3 time"
				label="Operating Hours End"
				name="operating_hours_end"
				placeholder="Choose time slot"
				></time-picker>			

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
			this.images = data.images ? data.images : this.images;
		},
	},

	data() {
		return {
			item: [],

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