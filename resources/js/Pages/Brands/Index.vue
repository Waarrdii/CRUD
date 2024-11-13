<template>
    <div>
        <h1>Brands</h1>
        <table class="w-full">
            <tr>
                <th>id</th>
                <th>name</th>
            </tr>
            <tr v-for="brand in brands" :key="brand.id">
                <td>{{ brand.id }}</td>
                <td>{{ brand.name }}</td>
            </tr>
        </table>
    </div>
</template>

<script setup>
const props = defineProps({
    brands:Array,
})
</script>

<style lang="scss" scoped>

</style>