<template>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                @change="selectAll($event)"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        update at
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-search-1" type="checkbox" 
                                v-model="selectedIds"
                                :value="product.id"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                        </div>
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">

                        <div class="text-base font-semibold">{{ product.name }}</div>
                    </th>
                    <td class="px-6 py-4">
                        {{ product.created_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ product.updated_at }}
                    </td>
                    <td class="px-6 py-4">
                        <Link :href="route('products.edit', product.id)"
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                    </td>

                </tr>
            </tbody>
        </table>

    </div>


    <div class="inline-flex rounded-md shadow-sm mt-5 ml-5">

        <Link :href="route('products.create')"
            class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
        New Data
        </Link>
        <a href="#" @click="deleteSelected"
            class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Delete
        </a>
    </div>


</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3'
import axios from 'axios';
import { Inertia } from '@inertiajs/inertia'


const props = defineProps({
    products: Array
})

const form = useForm({
    name: '',
    ids: [],
});

const selectAll = (event) => {
    if (event.target.checked) {
        selectedIds.value = props.products.map(product => product.id);
    } else {
        selectedIds.value = [];
    }
    console.log(selectedIds.value);
};

const selectedIds = ref([]);

const deleteSelected = () => {
    if (confirm("Hapus data product dipilih ?")){
        axios.delete(route('products.multipleDestroy'), {
            data: { ids: selectedIds.value },
            timeout: 10000,
        }).then(() => {
            Inertia.reload({ only: ['products'] });
        })
        
    }
}

</script>

<style lang="scss" scoped></style>