<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>
	
		<card>
			<template v-slot:header>Information Kit Content</template>

			<div class="row">
				<div class="form-group col-sm-12 col-md-12">
					<label>Name</label>
					<input v-model="item.name" name="name" type="text" class="form-control">
				</div>
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

			<div class="row">
				<div class="form-group col-sm-12 col-md-12 ">
	                <label for="downloadFile">Downloadable File</label> 
	                <a class="btn btn-primary btn-sm" target="_blank" :href="item.document_path_url" v-if="item.document_path_url"><i class="fa fa-eye"></i> View downloadable file</a>
	                <div class="input-group">
	                      <div class="custom-file">
	                        <input type="file" class="custom-file-input" name="downloadable_path" accept=".pdf, .doc, .docx" @change="filesSelected">
	                        <label class="custom-file-label" for="downloadFile">{{ file ? file[0].name : 'Choose File' }}</label>
	                      </div>
	                  </div>
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
			this.image_path = data.image_path ? data.image_path : this.image_path;
		},
 	  
 	    filesSelected(e) {
            this.file = e.target.files
        }	
	},

	props: {
        pageItem: {},
        noTitle: {
            default: false,
        },
        variants: Array,
        show: Boolean
    },

	data() {
		return {
			items: [],
			image_path: [],
            file: null

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