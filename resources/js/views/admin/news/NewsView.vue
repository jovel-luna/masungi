<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
		<meta-form
		:item="meta"
		></meta-form>

		<card>
			<template v-slot:header>News Information</template>

			<div class="row">
				<div class="form-group col-sm-12 col-md-12">
					<label>Title</label>
					<input v-model="item.title" name="title" type="text" class="form-control">
				</div>

				<date-picker
				v-model="item.published_date"
				class="form-group col-sm-12 col-md-12"
				label="Published Date"
				name="published_date"
				placeholder="Choose a date"
				></date-picker>

				<text-editor
				v-model="item.description"
				class="col-sm-12 col-md-12"
				label="Description"
				name="description"
				row="5"
				></text-editor>

				<!-- <div class="form-group col-sm-12 col-md-6">
					<label>Link</label>
					<input v-model="item.link" name="link" type="text" class="form-control">
				</div>	

				<div class="form-group col-sm-12 col-md-6">
					<label>Link Label</label>
					<input v-model="item.link_label" name="link_label" type="text" class="form-control">
				</div>	 -->
			
			</div>
			
			<div class="row">

				<image-picker
				:value="item.path"
				class="form-group col-sm-12 col-md-12 mt-2"
                label="Image (Aspect Ratio 16:9 Recommended)"
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
import MetaForm from '../../../components/forms/MetaForm.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.images = data.images ? data.images : this.images;
			this.meta = data.meta ? data.meta : this.meta;
		},
	},

	data() {
		return {
			items: [],
			images: [],
			meta: {},
		}
	},

	components: {
		'meta-form': MetaForm,
		'action-button': ActionButton,
		'selector': Select,
		'image-picker': ImagePicker,
		'text-editor': TextEditor,
		'date-picker': Datepicker,
	},

	mixins: [ CrudMixin ],
}
</script>