<template>
	<form-request :submit-url="submitUrl" @load="load" @success="fetch" confirm-dialog sync-on-success>

		<card>
			<template v-slot:header> Block Date And Time </template>

			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="form-group">
	                    <div class="custom-control custom-switch">
	                      	<input type="checkbox" class="custom-control-input" id="customSwitch1" v-model="item.is_whole_day" name="is_whole_day">
	                      	<label class="custom-control-label" for="customSwitch1">is Whole Day?</label>
	                    </div>
                  	</div>
				</div>
				<selector class="col-sm-12 col-md-6"
				v-model="item.trail_id"
				name="trail_id"
				label="Trail"
				:items="trails"
				item-value="id"
				item-text="name"
				empty-text="None"
				@change="init()"
				placeholder="Please select a Trail"
				></selector>

				<div class="form-group col-sm-12 col-md-6">
					<label>Reason</label>
					<input v-model="item.reason" name="reason" type="text" class="form-control">
				</div>
			</div>

			<div class="row">

				<date-picker
				v-model="item.date"
				class="form-group col-sm-12 col-md-6"
				label="Date"
				name="date"
				placeholder="Choose a date"
				@change="dateChanged()"
				></date-picker>

				<selector class="col-sm-6"
				v-show="!item.is_whole_day"
				v-model="item.slots"
				name="time_list[]"
				label="Time Slots"
				:items="time_datas"
				item-value="id"
				item-text="formatted_time_with_indicator"
				multiple
				placeholder="Please select time slots"
				></selector>
			</div>


			<div class="row">
				<text-editor
				v-model="item.description"
				class="col-sm-12"
				label="Description"
				name="description"
				row="5"
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
                :message="'Are you sure you want to archive Blocked Date # ' + item.id + '?'"
                :alt-message="'Are you sure you want to restore Blocked Date # ' + item.id + '?'"
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
import CrudMixin from 'Mixins/crud.js';

import ActionButton from 'Components/buttons/ActionButton.vue';
import Select from 'Components/inputs/Select.vue';
import ImagePicker from 'Components/inputs/ImagePicker.vue';
import TextEditor from 'Components/inputs/TextEditor.vue';
import Datepicker from 'Components/datepickers/Datepicker.vue';
import TimePicker from 'Components/timepickers/Timepicker.vue';

export default {
	methods: {
		fetchSuccess(data) {
			this.item = data.item ? data.item : this.item;
			this.time_datas = data.time_datas ? data.time_datas : this.time_datas;
			this.trails = data.trails ? data.trails : this.trails;

			this.dateChanged();
		},


		init() {
			let data = {
				id: this.item.id,
				trail_id: this.item.trail_id
			};

			axios.post(this.fetchUrl, data)
			.then(response => {
				this.time_datas = response.data.time_datas;
			})
			.catch(error => {
				console.log(error);
			});
		},


		dateChanged() {
			// this.time_slots = [];
			// _.each(this.time_datas, (time) => {
			// 	var parseDate = moment(this.item.date).format('YYYY-MM-DD');
			// 	var dateToCompare = moment(time.date).format('YYYY-MM-DD');

			// 	if(parseDate === dateToCompare) {
					// this.time_slots.push(time);
				// }
			// });
		},
	},

	data() {
		return {
			item: [],
			time_datas: [],
			trails: [],
			time_slots: [],
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
