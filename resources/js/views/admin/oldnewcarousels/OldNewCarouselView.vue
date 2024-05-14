<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header>Home Old New Carousel Information</template>

			<div class="row">
				<div class="col-sm-12 col-md-12">
					<label> Name </label>
					<input v-model="item.name" name="name" type="text" class="form-control">
				</div>			
			</div>

			<div class="row">
				<image-picker
				:value="item.old_image_path"
				class="form-group col-sm-12 col-md-12 mt-2"
                label="Old Masungi Image (Aspect Ratio : 1152 x 555px)"
                name="old_image_path"
                placeholder="Choose a File"
				></image-picker>
			</div>

			<div class="row">
				<image-picker
				:value="item.new_image_path"
				class="form-group col-sm-12 col-md-12 mt-2"
                label="New Masungi Image (Aspect Ratio : 1152 x 555px)"
                name="new_image_path"
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
                :message="'Are you sure you want to archive Sample Item #' + item.id + '?'"
                :alt-message="'Are you sure you want to restore Sample Item #' + item.id + '?'"
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

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.eventtypes = data.eventtypes ? data.eventtypes : this.eventtypes;			
			this.new_image_path = data.new_image_path ? data.new_image_path : this.new_image_path;
			this.old_image_path = data.old_image_path ? data.old_image_path : this.old_image_path;

		},
	},

	data() {
		return {
			items: [],
			old_image_path: [],			
			new_image_path: [],

		}
	},

	components: {
		'action-button': ActionButton,
		'selector': Select,
		'image-picker': ImagePicker,
		'text-editor': TextEditor,
		'date-picker': Datepicker,
	},

	mixins: [ CrudMixin ],
}
</script>