<template>
    <Create 
    :tabName="tabName" 
    v-if="tabName === 'products'"/>
    
</template>

<script setup>
import Create from '@/Pages/Products/Create.vue';

const props = defineProps({
    tabName: {
        type: String,
        required: true
    },
    childTabs : {
        type: Array
    },
    activeChildTabsIndex: {
        type: Number
    },
})


</script>

<style lang="scss" scoped></style>