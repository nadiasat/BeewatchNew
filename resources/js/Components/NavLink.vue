<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-2 py-2 bg-amber-400 text-sm font-semibold leading-5 text-gray-900 focus:outline-none rounded-lg transition duration-150 ease-in-out'
        : 'inline-flex items-center px-2 py-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:bg-amber-200/75 focus:outline-none focus:text-gray-700 focus:bg-amber-200/75 rounded-lg transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
