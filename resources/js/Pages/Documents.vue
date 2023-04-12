
<template>
    <Head title="Documents" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Documents</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Modal from "@/Components/Modal.vue";
import 'tippy.js/dist/tippy.css';
import 'tippy.js/themes/light-border.css';


import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";




export default {
    components: {
        AuthenticatedLayout,
        Head,
        Modal,
        BreezeLabel,
        BreezeInput,
    },
    data: () => ({
    }),
    methods: {
        addDocument() {
        
        },
        deleteDocument() {

        },
       
    },
    mounted() {
    },
};
</script>


