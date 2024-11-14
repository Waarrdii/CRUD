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
            <div v-show="tab.active">
                <Index :items="brandsData" :columns="columns"></Index>
            </div>
        </div>
    </div>
   
    <PrimaryButton @click="addTab()">Activate Tab</PrimaryButton>

</template>

<script setup>
import { onMounted, ref } from 'vue';

import PrimaryButton from '@/Components/PrimaryButton.vue';
import Index from '@/Components/Index.vue';


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

const brandsData = ref([]);
const columns = ref([]);
onMounted( async() => {
    try {
        const response = await axios.get(route('brands.showAllBrands'));
        brandsData.value = response.data;
        if(brandsData.value.length > 0){
            columns.value = Object.keys(brandsData.value[0]);
        }
    } catch (error) {
console.log(error);
    }
console.log(brandsData.value);
});
</script>

<style lang="scss" scoped>

</style>