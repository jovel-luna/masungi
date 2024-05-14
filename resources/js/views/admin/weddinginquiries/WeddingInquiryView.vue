<template>
	<div >
	
		<card>
			<template v-slot:header>Wedding Inquiry Information</template>

			<div class="row">
				<div class="form-group col-sm-12 col-md-6">
					<label> Full Name </label>
					<input v-model="item.fullname" name="fullname" type="text" class="form-control">
				</div>
				<div class="form-group col-sm-12 col-md-6">
					<label>Email</label>
					<input v-model="item.email" name="email" type="text" class="form-control">
				</div>
				<div class="form-group col-sm-12 col-md-6">
					<label>Contact #</label>
					<input v-model="item.contact_number" name="contact_number" type="text" class="form-control">
				</div>
				<div class="form-group col-sm-12 col-md-6">
					<label> Type of Event </label>
					<input v-model="item.eventtype" name="eventtype" type="text" class="form-control">
				</div>				
				<div class="form-group col-sm-12 col-md-6">
					<label>Number of Guest</label>
					<input v-model="item.guestsnumber" name="guestsnumber" type="text" class="form-control">
				</div>											

			</div>
			
			<div class="row">

				<text-editor
				v-model="item.message"
				class="col-sm-12"
				label="Messages (optional):"
				name="message" 
				row="5"
				></text-editor>
	
			</div>

			<template v-slot:footer>
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
                :message="'Are you sure you want to archive Inquiry #' + item.id + '?'"
                :alt-message="'Are you sure you want to restore Inquiry #' + item.id + '?'"
                :disabled="loading"
                @load="load"
                @success="fetch"
                @error="fetch"
                ></action-button>
			</template>
		</card>

		<loader :loading="loading"></loader>
		
	</div>
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