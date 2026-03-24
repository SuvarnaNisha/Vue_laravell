<template>
    <form >
        <div class="mb-4 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center gap-2">

                <input type="checkbox" id="deleted" 
                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                v-model="filterForm.deleted"
                >
                <label for="deleted" > Deleted</label>
            </div>

            <div>
                <select name="" id="" class="input-filter-l w-24" v-model="filterForm.by" >
                    <option value="created_at">Added</option>
                    <option value="price">Price</option>
                </select>
                <select name="" id="" class="input-filter-r w-32" v-model="filterForm.order">
                    <option value="" v-for="option in sortOptions" :key="option.value"
                     :value="option.value">
                        {{ option.label }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>

<script setup>
    // import { data } from 'autoprefixer';
import { computed, reactive, watch } from 'vue';
// import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import {debounce} from 'lodash'

    const props = defineProps({
        filters: Object,
    })

    console.log("props: " + props);
    console.log("props: " + JSON.stringify(props) );
    console.log("props: " + JSON.stringify(props.filters) );

    const filterForm = reactive({
        deleted: props?.filters?.deleted ?? false,
        by: props?.filters?.by ?? 'created_at',
        order: props?.filters?.order ?? 'desc',
    })

    const sortLabels = {
        created_at: [
            {
                label: 'Latest',
                value: 'desc'
            },
             {
                label: 'Oldest',
                value: 'asc'
            },
        ],
        price: [
            {
                label: 'Pricey',
                value: 'desc',
            },
            {
                label: 'cheapest',
                value: 'asc',
            }
        ]
    }

    const sortOptions = computed(() => sortLabels[
        filterForm.by
    ]);

    // const filterForm = reactive({
    //     deleted: false,
    //     by: 'created_at',
    //     order: 'desc'
    //     // xxx: 0,
    // });

    watch(
        // filterForm, (newValue, oldValue) => console.log( newValue, oldValue)
        // () => filterForm.deleted, (newValue, oldValue) => console.log( newValue, oldValue)
        
        // filterForm, () => router.get(
        //     route('realtor.listing.index'),
        //     filterForm,
        //     {
        //         preserveState: true,
        //         preserveScroll:true
        //     },
        // ),

        filterForm, debounce(() => router.get(
            route('realtor.listing.index'),
            filterForm,
            {   
                preserveState: true,
                preserveScroll:true
            },
        ), 1000),

    )


</script>