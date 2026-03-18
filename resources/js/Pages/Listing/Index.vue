<template v-if="listings?.data">
	<Filters :filters="filters" />
	<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
		<Listing v-for="listing in listings.data" :key="listing.id" :listing="listing">
			<!-- <div> -->
				<!-- <Link :href="`/listing/${listing.id}`"> -->
				<!-- <Link :href="route('listing.show', listing.id)"> -->
				<!-- <Link :href="route('listing.show', {listing: listing.id} )">

					<div class="flex items-center gap-1">
						<Price :price="listing.price" class="text-2xl font-bold" />
						<div class="text-xs text-gray-500">
							<Price :price="400" /> pm
						</div>
					</div>	
 
					<ListingSpace :listing="listing" class="text-lg"></ListingSpace>
					<ListingAddress :listing="listing" class="text-gray-500"/>
				</Link> -->
			<!-- </div>
			<div> -->
				<!-- <Link :href="`/listing/${listing.id}/edit`">Edit</Link> -->
				<!-- <Link :href="route('listing.edit', {listing: listing.id})">Edit</Link> -->
			<!-- </div> -->
			
			<!-- <div> -->
				<!-- <Link :href="`/listing/${listing.id}`" method="DELETE" as="button">Delete</Link> -->
				<!-- <Link :href="route('listing.destroy', {listing: listing.id})" method="DELETE" as="button">Delete</Link> -->
			<!-- </div> -->
			
		</Listing>
	</div>

	<div v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
		<Pagination :links="listings.links" />
	</div>
 </template>
 
<script setup>
 
	import Listing from '@/pages/Listing/Index/Components/Listing.vue';
	import Pagination from '../../Components/UI/Pagination.vue';
	// import Filters from '@/Pages/Listing/Index/Componenets/Filters.vue';
	import Filters from '@/Pages/Listing/Index/Components/Filters.vue';

	defineProps({
		// listings: Array
		listings: Object,
		filters: Object,
	})
</script> 


 