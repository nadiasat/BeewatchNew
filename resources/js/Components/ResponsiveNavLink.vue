<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'flex flex-row gap-2 items-center w-full pl-3 pr-4 py-2 border-l-4 border-amber-400 text-left text-base font-medium text-zinc-700 bg-amber-100 focus:outline-none focus:text-zinc-800 focus:bg-amber-100 focus:border-amber-400 transition duration-150 ease-in-out'
        : 'flex flex-row gap-2 items-center w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-zinc-400 hover:text-zinc-800 hover:bg-amber-50 hover:border-amber-200 focus:outline-none focus:text-zinc-800 focus:bg-amber-50 focus:border-amber-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
