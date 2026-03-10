<template>
    <div>
        <span class="font-bold"> {{ listing.beds }} </span> bds 
        <span class="text-gray-400">|</span> &nbsp;
        <span class="font-bold">{{ listing.baths }}</span>  &nbsp;
        <span class="text-gray-400">|</span> ba 
    </div>
</template>

<script setup>
defineProps({
    listing: Object,
})
</script>