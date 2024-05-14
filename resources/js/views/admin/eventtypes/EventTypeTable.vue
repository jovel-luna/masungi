<template>
    <div>
        <filter-box @refresh="fetch">
            <template v-slot:left>
            </template>
            <template v-slot:right>

                <search-form
                @search="filter($event, 'search')">
                </search-form>

            </template>
        </filter-box>

        <!-- DATATABLE -->
        <data-table
        ref="data-table"
        :headers="headers"
        :filters="filters"
        :fetch-url="fetchUrl"
        :no-action="noAction"
        :disabled="disabled"
        order-by="id"
        @load="load"
        order-desc
        >

            <template v-slot:body="{ items }">
                <tr v-for="item in items">
                    <td>
                        <view-button :href="item.showUrl"></view-button>
                        
                        <action-button
                        v-if="!hideButtons"
                        small 
                        color="btn-danger"
                        alt-color="btn-warning"
                        :show-alt="item.deleted_at"
                        :action-url="item.archiveUrl"
                        :alt-action-url="item.restoreUrl"
                        icon="fas fa-trash"
                        alt-icon="fas fa-trash-restore-alt"
                        confirm-dialog
                        :disabled="loading"
                        title="Archive Item"
                        alt-title="Restore Item"
                        :message="'Are you sure you want to archive Trail #' + item.id + '?'"
                        :alt-message="'Are you sure you want to restore Trail #' + item.id + '?'"
                        @load="load"
                        @success="sync"
                        ></action-button>
                    </td>
                    <td>{{ item.id }}</td>
                    <td>{{ item.event_id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.duration }}</td>
                    <td>{{ item.age_group }}</td>
                    <td>{{ item.participants }}</td>
                    <!-- <td>{{ item.conservation_fees }}</td> -->
                    <!-- <td>{{ item.description }}</td>                     -->
                    <td>{{ item.created_at }}</td>
                </tr>
            </template>

        </data-table>

        <loader :loading="loading"></loader>
    </div>
</template>

<script type="text/javascript">
import ListMixin from '../../../mixins/list.js';

import SearchForm from '../../../components/forms/SearchForm.vue';
import ActionButton from '../../../components/buttons/ActionButton.vue';
import ViewButton from '../../../components/buttons/ViewButton.vue';

export default {
    computed: {
        headers() {
            let array = [
                { text: '#', value: 'id' },
                { text: 'Event', value: 'event_id' },
                { text: 'Name', value: 'name' },
                { text: 'Duration', value: 'duration' },
                { text: 'Age Group', value: 'age_group' },
                { text: 'Participants', value: 'participants' },
                // { text: 'Conservation Fees', value: 'conservation_fees' },
                // { text: 'Description', value: 'description' },

            ];

            array = array.concat([
                { text: 'Created Date', value: 'created_at' },
            ]);

            return array;
        },
    },

    props: {
        hideParent: {
            default: false,
            type: Boolean,
        },

        hideButtons: {
            default: false,
            type: Boolean,
        },
    },

    mixins: [ ListMixin ],

    components: {
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
    },
}
</script>