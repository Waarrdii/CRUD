<script setup>
import TableComponent from './Table/TableComponent.vue';
import TableHead from './Table/TableHead.vue';
import TableData from './Table/TableData.vue';
import TableRow from './Table/TableRow.vue';
import Checkbox from './Checkbox.vue';
import UrlLink from './UrlLink.vue';
import { onMounted, ref } from 'vue';
import axios from 'axios';

import SecondaryTab from './SecondaryTab.vue';

const props = defineProps({
    items: Array,
    columns: Array,
    tabName: {
        type: String,
        required: true
    },
});

const brands = ref([]);
const isLoading = ref(true);

onMounted( async () => {
    const response = await axios.get(route('brands.showAllBrands'));
    brands.value = response.data;
    isLoading.value = false;
})

</script>

<template>
    <SecondaryTab :tabName="tabName">
        <template #header>
            <h2>Index</h2>
        </template>
        <template #default>
            <div v-if="isLoading">
                Loading data...
            </div>

            <TableComponent v-if="brands.length && items.length > 0">
                <TableHead v-for="column in columns" :key="column">{{ column }}</TableHead>
                <TableRow v-for="item in items" :key="item.id">
                    <TableData v-for="column in columns" :key="column">
                        <template v-if="column === 'name'">
                            <UrlLink :href="route('products.edit', item.id)">
                                {{ item.name }}
                            </UrlLink>
                        </template>
                        <template v-else-if="column === 'brand_id'">
                            {{ brands.find(brand => brand.id === item.brand_id).name }}
                        </template>
                           
                        <template v-else>
                            {{ item[column] }}
                        </template>
                    </TableData>
                </TableRow>
            </TableComponent>
            
        </template>
    </SecondaryTab>




</template>