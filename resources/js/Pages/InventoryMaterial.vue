
<template>
    <Head title="Stock Matériel" />

    <AuthenticatedLayout>
        <div class="container mx-auto p-4 w-full">
                <div>
                    <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">   
                        <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Stock du matériel</h2>
                    </div>
                </div>

                <div class=" px-4 mx-auto h-full">
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
    props: ['users'],
    data: () => ({
    }),
    methods: {
        addDocument() {
        
        },
        deleteEvent() {

        },
       
    },
    mounted() {
        console.log(this.events);
    },
};
</script>


