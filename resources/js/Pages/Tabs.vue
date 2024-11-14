<template>
    <div 
    class="m-5 w-auto flex flex-start"
    v-if="activeTab.length > 0">
        <div v-for="(tab, index) in activeTab" :key="tab.id"
        @click="activateTab(index)"
        class="first:rounded-tl-md last:rounded-tr-md border-r bg-gray-100 p-2 hover:bg-gray-200 cursor-pointer">
            <div class="">Tab {{ tab.id }}</div>
            
        </div>
    </div>
    <div
    class="m-5 w-auto flex flex-start"
    v-if="activeTab.length > 0">
        <div v-for="(tab, index) in activeTab" :key="tab.id">
            <div id="showProduct" v-show="tab.active">
                <!-- component Product/Index.vue akan di muat disini -->
                 <slot/>
            </div>
        </div>
    </div>
   
    <PrimaryButton @click="addTab">Activate Tab</PrimaryButton>

    <Link :href="route('products.index')" @click="addTab">link product</Link>

</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const activeTab = ref([]);

const addTab = () => {
    const newValue = {
        id:activeTab.value.length + 1,
        active:false,
    };
    activeTab.value = [...activeTab.value, newValue];
    activateTab(activeTab.value.length - 1);
};

const activateTab = (index)=>{
    activeTab.value.forEach((tab, i)=>{
        tab.active = (i === index);
    })
}

</script>

<style lang="scss" scoped>

</style>