<template>
    <div class="w-auto flex flex-start">
        <div v-for="(nav, index) in childTabs" :key="nav.id"
            class="select-none first:rounded-tl-md last:rounded-tr-md border-r bg-gray-100 p-1 hover:bg-gray-200 cursor-pointer flex flex-start relative">
            <div 
            @click="activeChildTab(index)"
            class="Capitalize p-1 mr-3">{{ nav.id }}</div>
            <div 
            @click="removeChildTab(index)" 
            v-if="index !== 0" 
            class="absolute right-1 top-1">
                <CloseIcons/>                
            </div>
        </div>
    </div>
    <div 
    class="w-auto flex flex-start">
        <div v-for="(nav, index) in childTabs" :key="nav.id" v-show="nav.active">
            <div v-if="index === 0">
                <slot />
            </div>
            <div v-else>
                <CreateForm :tabName ="tabName" :childTabs="childTabs" :activeChildTabsIndex="activeChildTabsIndex"/>
            </div>
        </div>
    </div>

    <div v-if="activeChildTabsIndex === 0"
    class="flex flex-start space-x-2 py-2">
        <GreenButton @click="addChildTab('New Data')">New</GreenButton>
        <DangerButton>Delete</DangerButton>
        <PurpleButton>Export</PurpleButton>
        <PrimaryButton>Import</PrimaryButton>
    </div>

</template>

<script setup>
import { onMounted, provide, ref } from 'vue';

import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PurpleButton from '@/Components/PurpleButton.vue';
import GreenButton from '@/Components/GreenButton.vue';
import CloseIcons from './CloseIcons.vue';

import CreateForm from './CreateForm.vue';

const props = defineProps({
    tabName: {
        type: String,
        required: true
    },
});

const childTabs = ref([])
const activeChildTabsIndex = ref(0)

const activeChildTab = (index) => {
    childTabs.value.forEach((nav, i) => {
        nav.active = (i === index);
    })
    activeChildTabsIndex.value = index;
}

const removeChildTab = (index) => {
    if(index !== 0){
        childTabs.value.splice(index, 1);
    } if(index > 0 && activeChildTabsIndex.value >= index){
        activeChildTabsIndex.value--;
    }
    activeChildTab(activeChildTabsIndex.value);
    
}
const addChildTab = async (childTabName) => {
    childTabs.value.push({
        id: childTabName,
        active: true
    })
    activeChildTab(childTabs.value.length - 1);
}

onMounted(() => {
    childTabs.value.push({
        id: 'Index',
        active: true,
    })
})

const provideData ={
    childTabs,
    activeChildTabsIndex,
    removeChildTab,
}

provide('provideData', provideData);
</script>

<style lang="scss" scoped></style>