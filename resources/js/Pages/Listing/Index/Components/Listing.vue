<template>
    <Box >
        <div>
            <Link :href="route('listing.show', {listing: listing.id} )">

                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> pm
                    </div>
                </div>	

                <ListingSpace :listing="listing" class="text-lg"></ListingSpace>
                <ListingAddress :listing="listing" class="text-gray-500"/>
            </Link>
        </div>
        <div>
            <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link>
        </div>
        
        <div>
            <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE" as="button">Delete</Link>
        </div>        
    </Box>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
	// import MainLayout from '../../Layouts/MainLayout.vue';
    import ListingAddress from '@/Components/ListingAddress.vue';
	import { route } from 'ziggy-js';
    import Box from '@/Components/UI/Box.vue';
    import ListingSpace from '@/Components/ListingSpace.vue';
    import Price from '@/Components/Price.vue';
    import {useMonthlyPayments} from '@/Composables/useMonthlyPayment';
    import {ref} from 'vue';

    const props = defineProps({listing:Object })

    const interestRate = ref(2.5)
    const duration = ref(25)

    const {monthlyPayment} = useMonthlyPayments(
        props.listing.price, interestRate, duration
    )
     

</script>