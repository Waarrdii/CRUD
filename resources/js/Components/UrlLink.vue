<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>

</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    }
});

const classes = 'hover:underline'

</script>

<style lang="scss" scoped>

</style>