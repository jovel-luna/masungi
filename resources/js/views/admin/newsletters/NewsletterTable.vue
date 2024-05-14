<template>
    <div>
        <div class="card">
            <div class="card-header">               
                <form-request :submit-url="exportUrl" @load="load" submit-on-success method="POST" :action="exportUrl">         
                    <filter-box @refresh="fetch">
                        <template v-slot:left>
                                <action-button 
                                v-if="exportUrl"
                                class="mr-2"
                                type="submit"
                                :disabled="loading"
                                color="btn-success"
                                icon="fa fa-file-excel"
                                ><i class="" aria-hidden="true"></i>
                                Export to Excel
                                </action-button> 
                        </template>

                        <template v-slot:right>

                            <search-form
                            @search="filter($event, 'search')">
                            </search-form>

                        </template>    

                    </filter-box>
                </form-request>
            </div>

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
                        :message="'Are you sure you want to archive Inquiry #' + item.id + '?'"
                        :alt-message="'Are you sure you want to restore Inquiry #' + item.id + '?'"
                        @load="load"
                        @success="sync"
                        ></action-button>
                    </td>
                    <td>{{ item.id }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.created_at }}</td>
                </tr>
            </template>

        </data-table>
    </div>

        <loader :loading="loading"></loader>
    </div>
</template>

<script type="text/javascript">
import ListMixin from '../../../mixins/list.js';
import { EventBus }from '../../../EventBus.js';
import SearchBox from '../../../components/datatables/SearchBox.vue';
import ActionButton from '../../../components/buttons/ActionButton.vue';
import ViewButton from '../../../components/buttons/ViewButton.vue';
import DateRange from '../../../components/datepickers/DateRange.vue';
import FormRequest from '../../../components/forms/FormRequest.vue';
import Select from '../../../components/inputs/Select.vue';
import Datepicker from '../../../components/datepickers/Datepicker.vue';
import SearchForm from '../../../components/forms/SearchForm.vue';

export default {
    methods: {

    },

    computed: {
        headers() {
            let array = [
                { text: '#', value: 'id' },
                { text: 'Subscriber', value: 'email' },
            ];


            array = array.concat([
                { text: 'Created Date', value: 'created_at' },
            ]);

            return array;
        },
    },

    props: {
        exportUrl: String,


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
        'form-request': FormRequest,
    },
}
</script>