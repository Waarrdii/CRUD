<template>
<Welcome>
    <template #header>
        <h1>Data Brands</h1>
    </template>
    <template #default>
        <Index :items="brands" :columns="columns"></Index>
    </template>
</Welcome>
    
</template>
    


<script setup>
import { ref } from 'vue';
import Index from '@/Components/Index.vue';
import Welcome from '../Welcome.vue';

const props = defineProps({
    brands: Array,
})

const columns = ref(Object.keys(props.brands[0]));
</script>

<style lang="scss" scoped></style>