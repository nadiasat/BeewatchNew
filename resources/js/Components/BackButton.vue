<template>
    <button @click="goBack()" class="flex justify-center items-center mb-4 border-zinc-900 bg-white text-zinc-900 border-2 rounded-lg py-3 font-semibold w-10 mr-5 hover:bg-zinc-900 hover:text-white">
        <svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 1L1 7L9 13" stroke="currentColor" stroke-linecap="round"/>
        </svg>
    </button>
</template>

<script>

import {Inertia} from "@inertiajs/inertia";

export default {
    name: "BackButton",
    props: ['previousRoute'],
    setup(props) {
        const goBack = () => {
            //go back to previous route
            Inertia.visit(props.previousRoute);
        }
        return {
            goBack
        }
    }
}
</script>