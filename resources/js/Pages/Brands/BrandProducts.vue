<template>
    <div>
        <h1>Products List by {{ brand.name }}</h1>
        <ul>
            <li v-for="product in products" :key="product.id">{{ product.name }}</li>
        </ul>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';


const props = defineProps({
    brand : Array,
    products : Array,
})


</script>

<style lang="scss" scoped>

</style>