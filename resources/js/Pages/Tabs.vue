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
            <p v-show="tab.active">
                Tab :{{ tab.id }} <br/>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident praesentium nihil reprehenderit necessitatibus magnam nisi dolorem error aperiam adipisci! Distinctio dolore alias magni illo, magnam corporis tenetur exercitationem at. Consequatur?
            </p>
        </div>
    </div>
   
    <PrimaryButton @click="addTab">Activate Tab</PrimaryButton>

</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
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