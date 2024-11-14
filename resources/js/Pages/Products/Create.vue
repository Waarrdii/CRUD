<template>
    <form @submit.prevent="submit" class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
            <input type="text" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Product Name" required v-model="form.name" />
        </div>
        <div class="mb-5">
            <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brand</label>
            <input type="text" id="brand" @click="showModal"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Brand" required v-model="form.brand_name"/>
        </div>
        <div class="mb-5">
            <Modal :show="modalShow">
                <div class="relative p-0 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="border-b rounded-t dark:border-gray-600">
                            <form class="max-full mx-auto">
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search" v-model="searchQuery"
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-transparent rounded-lg bg-gray-50  focus:border-0 focus:ring-0 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-0 dark:focus:border-0"
                                    placeholder="Search Brands..." required />
                            </div>
                        </form>
                        </div>

                        

                        <!-- Modal body -->
                        <div class="space-y-4">
                            <ul>
                                <li class="py-2 px-4 hover:bg-gray-100 cursor-pointer"
                                v-for="brand in filteredBrands" :key="brand.id"
                                @click="selectBrand(brand)"
                                >
                                {{ brand.name }}
                            </li>
                            </ul>
                               
                        </div>
                        <!-- Modal footer -->
                        <div
                            class="flex justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                            
                            <button @click="closeModal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cencel</button>
                        </div>
                    </div>
                </div>

            </Modal>

        </div>


        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, defineProps, computed } from 'vue';
import Modal from '@/Components/Modal.vue';

const props = defineProps({
    brands: Array,
});

const filteredBrands = computed(() => {
    return props.brands.filter(
        brand => brand.name.includes(searchQuery.value)
    );
});

const searchQuery = ref('');
const modalShow = ref(false);

const showModal = () => {
    modalShow.value = true;
    // console.log(props.brands);
};

const closeModal = () => {
    modalShow.value = false;
};

const form = useForm({
    name: '',
    brand_id: '',
    brand_name: '',
});
const selectBrand = (brand) => {
    form.brand_name = brand.name;
    form.brand_id = brand.id;
    closeModal();
}


const submit = () => {
    form.post(route('products.store'));
};


</script>

<style lang="scss" scoped></style>