<!-- <template>Hello {{counter}} </template> -->
 <template>
	<!-- <div>Index</div> -->
	<!-- <Link href="/hello">Show Pages</Link> -->

	<div v-for="listing in listings">
		{{ listing.city }}
	</div>
 </template>

<script setup>
 	import { Link } from '@inertiajs/vue3'
	import MainLayout from '../../Layouts/MainLayout.vue';

	defineProps({
		// message: String
		listings: Array
	})

 	// defineProps(['message'])
	
	// import {ref} from 'vue'
	// const counter = ref(0)
	// setInterval(() => counter.value++, 1000)
</script> 

<!-- <script>
	import MainLayout from '../../Layouts/MainLayout.vue';
	export default {
		layout: MainLayout
	}
</script>  This code is now added in app.js file so commenting here -->

 