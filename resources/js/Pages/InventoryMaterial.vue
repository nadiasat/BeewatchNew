
<template>
    <Head title="Stock Matériel" />

    <AuthenticatedLayout>
        <div class="container mx-auto p-4 w-full">
                <div>
                    <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">   
                        <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Stock du matériel</h2>
                        <div class="flex flex-row justify-center">
                             
                        </div>
                    </div>
                </div>

                <hr>

                <BreezeValidationErrors class="my-8" />


                <div class="mt-8">
                    <MaterialList
                    :materials="materials" :inventory_places="inventory_places"></MaterialList>
                </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import {ref} from 'vue';
import Modal from "@/Components/Modal.vue";
import MaterialList from "@/Components/Material/MaterialList.vue";
import MaterialCreate from '@/Components/Material/MaterialCreate.vue';


import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";




export default {
    components: {
        AuthenticatedLayout,
        Head,
        Modal,
        BreezeLabel,
        BreezeInput,
        MaterialList,
        MaterialCreate
    },
    props: ['materials', 'inventory_places'],
    mounted() {

    },
};
</script>


