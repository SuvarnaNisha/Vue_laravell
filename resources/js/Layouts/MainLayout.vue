<template>
    <!-- <Link href="/">Main Page</Link>&nbsp; -->
    <!-- <Link href="/listing">Listings</Link>&nbsp; -->
    <!-- <Link href="/listing/create">New Listing</Link> -->

    <!-- <div>
         The page with time {{ timer }} 
    </div>    -->

    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-lg text-indigo-300 font-bold text-center">
                    <Link :href="route('listing.index')">Larazilla</Link>
                </div>
                <div v-if="user" class="flex items-center gap-4">
                    <Link class="text-sm text-gray-500" :href="route('realtor.listing.index')" >{{ user.name }}</Link>
                    <Link :href="route('realtor.listing.create')" class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md">+ New Listing</Link>
                    <div>
                        <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                    </div>
                </div>
                <div v-else class="flex items-center gap-2">
                    <Link :href="route('user-account.create')">Register</Link>
                    <Link :href="route('login')">Sign-In</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900">
            <!-- success -->
            {{ flashSuccess }}
        </div>

        <slot>Default</slot>
    </main>

    <!-- <div>{{ y }}</div> -->
    
</template>

<script setup>
    import { ref, computed  } from 'vue';
    import { Link, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
    
    const x = ref(0)
    const y = computed(() => x.value * 2)

    const page = usePage()

    const user = computed(() => page.props?.user ?? null)
    const flashSuccess = computed(() => page.props?.flash?.success ?? null)
    
    // import { ref } from 'vue'
    // const timer = ref(0)
    // setInterval(() => timer.value++, 1000 )
</script>

<!-- <style scoped>
    .success{
        background-color: green;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
</style> -->