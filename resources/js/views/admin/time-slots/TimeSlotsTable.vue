<template>
    <div>
        <loader
            :loading="loading"
        ></loader>

        <draggable 
            v-model="items" 
            group="people" 
            @start="drag=true" 
            @end="drag=false"
            :disabled="!canReorder ? true: false"
        >
            <div v-for="(item, index) in items" :key="item.id" 
                class="form-group" 
            >

                <div class="row">
                    <div class="col-md-6 text-center">
                        <view-button :href="item.showUrl"></view-button>    

                        <action-button
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
                        title="Archive Timeslot"
                        alt-title="Restore Timeslot"
                        :message="'Are you sure you want to archive Timeslot #' + item.id + '?'"
                        :alt-message="'Are you sure you want to restore Timeslot #' + item.id + '?'"
                        @success="success"
                        ></action-button>

                    </div>
                    <div class="col-md-6 text-center">
                        <label 
                            class="badge"
                        >{{ index+1 }}) {{ item.time }}</label>      
                    </div>
                </div>

            </div>

            <template v-if="items.length === 0">
                <div class="form-group text-center">
                    <label>No data found</label>
                </div>
            </template>
        
        </draggable>

        <hr />

        <template v-if="canReorder">
            <div class="row" >
                <div class="col-md-12 text-right">
                    <button 
                    @click="saveOrder()"
                    :disbled="loading"
                    class="btn btn-primary">Save Order</button>
                </div>
            </div>
        </template>
    </div>
</template>

<script type="text/javascript">
import ListMixin from 'Mixins/list.js';
import ResponseHandler from 'Mixins/response.js';

import SearchForm from 'Components/forms/SearchForm.vue';
import ActionButton from 'Components/buttons/ActionButton.vue';
import ViewButton from 'Components/buttons/ViewButton.vue';
import draggable from 'vuedraggable';
import { EventBus } from '../../../EventBus.js';

export default {

    computed: {
        headers() {
            let array = [];

            return array;
        },
    },

    props: {
        fetchUrl: String,
        submitUrl: String,
        canReorder: {
            type: Boolean,
            default: true,
        }
    },
    
    data() {
        return {
            items: [],
            loading: false
        }
    },

    mixins: [ ResponseHandler, ListMixin ],


    mounted() {
        this.init();
        this.refreshList();
    },

    methods: {
        init() {
            this.loading = true;

            axios.post(this.fetchUrl)
                .then((response) => {
                    this.loading = false;

                    if(response.status === 200) {
                        this.items = response.data.items;
                    }
                }) .catch((error) => {
                    this.loading = false;
                    this.parseError(error);
                })
        },

        success() {
            this.init();
            EventBus.$emit('refresh');
        },

        refreshList() {
            EventBus.$on('refresh', () => {
                this.init();
            });         
        },

        saveOrder() {
            this.loading = true;
            axios.post(this.submitUrl, {'items': this.items})
                .then((response) => {
                    this.loading = false;
                    if(response.status === 200) {
                        this.parseSuccess(response.data.message);
                        this.init();
                    }

                }).catch((error) => {
                    this.loading = false;                 
                    this.parseError(error);
                });
        },
    },

    components: {
        draggable,
        'search-form': SearchForm,
        'view-button': ViewButton,
        'action-button': ActionButton,
    },
}
</script>
