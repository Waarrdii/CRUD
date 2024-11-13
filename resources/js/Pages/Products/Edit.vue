<template>
    <form @submit.prevent="submit" class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product Name</label>
            <input type="text" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Product Name" required v-model="form.name" />
        </div>
        <div class="space-x-2">
            <SaveButton type="submit">simpan</SaveButton>
            <DangerButton @click.prevent="deleteData"> hapus</DangerButton>
        </div>
        
    </form>
    
       
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import DangerButton from '@/Components/DangerButton.vue';
import SaveButton from '@/Components/SaveButton.vue';

const props = defineProps({
    product: Object,
})

const form = useForm({
    name: props.product.name,
});

const submit = () => {
    form.put(route('products.update', props.product.id, form));
};

const deleteData = () => {
    if (confirm("Hapus data product ?")){
        form.delete(route('products.destroy', props.product.id));
    }
   
};

</script>

<style lang="scss" scoped></style>