<template>
    <div 
    class="m-5 w-auto flex flex-start"
    v-if="activeTab.length > 0">
        <div v-for="(tab, index) in activeTab" :key="tab.id"
        @click="activateTab(index)"
        :class="[tab.active ? 'bg-gray-200' : 'bg-gray-100']" class="first:rounded-tl-md last:rounded-tr-md border-r bg-gray-100 p-2 hover:bg-gray-200 cursor-pointer ">
            <div class="uppercase">{{ tab.id }}</div>
            
        </div>
    </div>
    <div
    class="m-5 w-auto flex flex-start"
    v-if="activeTab.length > 0">
        <div v-for="(tab, index) in activeTab" :key="tab.id">
            <div v-show="tab.active">
                <Index :items="tab.data" :columns="tab.columns"></Index>
            </div>
        </div>
    </div>
   
    <PrimaryButton @click="openTab('brands')">Brands</PrimaryButton>
    <PrimaryButton @click="openTab('products')">Products</PrimaryButton>

</template>

<script setup>
import { onMounted, ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Index from '@/Components/Index.vue';


const activeTab = ref([]);

const activateTab = (index)=>{
    activeTab.value.forEach((tab, i)=>{
        tab.active = (i === index);
    })
}

const openTab = async(tabName) => {
    let response;
    let columns;
    const existTab = activeTab.value.findIndex(tab => tab.id === tabName);
    if (existTab !== -1) {
        activateTab(existTab);
        return;
    }
    if (tabName === 'brands') {
        response = await axios.get(route('brands.showAllBrands'));
        columns = ref(Object.keys(response.data[0]));
    } else if (tabName === 'products') {
        response = await axios.get(route('products.showAllProducts'));
        columns = ref(Object.keys(response.data[0]));
    }
    
    activeTab.value.push ({
        id: tabName,
        active: true,
        data: response.data,
        columns: columns
    })
    activateTab(activeTab.value.length - 1);
}


</script>

<style lang="scss" scoped>

</style>