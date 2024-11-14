<script setup>
import TableComponent from './Table/TableComponent.vue';
import TableHead from './Table/TableHead.vue';
import TableData from './Table/TableData.vue';
import TableRow from './Table/TableRow.vue';

const props = defineProps({ 
    items: Array,
    columns: Array  
});

</script>

<template>
    <TableComponent>
            <TableHead v-for="column in columns" :key="column">{{column}}</TableHead>
            <TableRow v-for="item in items" :key="item.id">
                <TableData v-for="column in columns" :key="column">{{item[column]}}</TableData>
            </TableRow>
    </TableComponent>
</template>