<template>
    <TableComponent>
        <template #header>
            <TableHead>
                <div class="flex items-center space-x-1">
                    <Checkbox :checked="false" @change="selectAll($event)" />
                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                    <div>Name</div>
                </div>
            </TableHead>
            <TableHead>Brand</TableHead>
            <TableHead>Created At</TableHead>
            <TableHead>update at</TableHead>
        </template>
        <template #default>
            <TableRow v-for="product in products" :key="product.id">
                <TableHead scope="row">
                    <div class="flex items-center space-x-1">
                        <Checkbox v-model:checked="selectedIds" :value="product.id" />
                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        <UrlLink :href="route('products.edit', product.id)">
                            {{ product.name }}
                        </UrlLink>
                    </div>
                </TableHead>
                <TableData>
                    <UrlLink :href="route('brands.products.index', product.brand)">
                        {{ product.brand.name }}
                    </UrlLink>
                </TableData>
                <TableData>{{ product.created_at }}</TableData>
                <TableData>{{ product.updated_at }}</TableData>
                

            </TableRow>
        </template>
    </TableComponent>

    <div class="inline-flex mt-5 ml-5 space-x-2">
        <PrimaryButton @click="newData">New Data</PrimaryButton>
        <DangerButton @click="deleteSelected" :disabled="selectedIds.length === 0">Delete</DangerButton>
        <PurpleButton>Export</PurpleButton>
        <GreenButton>Import</GreenButton>
    </div>

</template>

<script setup>
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3'
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia'
import UrlLink from '@/Components/UrlLink.vue';
import Checkbox from '@/Components/Checkbox.vue';


import TableComponent from '@/Components/Table/TableComponent.vue';
import TableHead from '@/Components/Table/TableHead.vue';
import TableRow from '@/Components/Table/TableRow.vue';
import TableData from '@/Components/Table/TableData.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PurpleButton from '@/Components/PurpleButton.vue';
import GreenButton from '@/Components/GreenButton.vue';
import Tabs from '../Tabs.vue';



const props = defineProps({
    products: Array,
})

const form = useForm({
    name: '',
    ids: [],
});

const selectAll = (event) => {
    if (event.target.checked) {
        selectedIds.value = props.products.map(product => product.id);
        console.log(props.brands);
    } else {
        selectedIds.value = [];
    }
};

const selectedIds = ref([]);

const newData = () => {
    router.get(route('products.create'));
}
const deleteSelected = () => {
    if (confirm("Hapus data product dipilih ?")) {
        axios.delete(route('products.multipleDestroy'), {
            data: { ids: selectedIds.value },
            timeout: 10000,
        }).then(() => {
            router.reload({ only: ['products'] });
        })

    }
}


</script>

<style lang="scss" scoped></style>