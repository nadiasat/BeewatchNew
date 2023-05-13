
<template>
    <Head title="Stock Miel" />

    <AuthenticatedLayout>
        <div class="container mx-auto p-4 w-full">
                <div>
                    <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">   
                        <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Stock du miel</h2>
                        <HoneyJarCreate></HoneyJarCreate>
                    </div>
                </div>

                <hr>

                <BreezeValidationErrors class="my-8" />


                <div class="my-8
                grid grid-cols-2 lg:grid-cols-3
                auto-rows-min
                auto-cols-min gap-4">
                    <HoneyJarCard v-for="honey_jar in honey_jars" :honey_jar="honey_jar"></HoneyJarCard>
                </div>

                <hr>

                <div class="my-8">
                    <HoneyJarsRecord :records="records" :jars="honey_jars" :users="users"></HoneyJarsRecord>
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
import HoneyJarCard from '@/Components/Honey/HoneyJarCard.vue';
import HoneyJarsRecord from '@/Components/Honey/HoneyJarsRecord.vue';
import HoneyJarsEdit from '@/Components/Honey/HoneyJarsEdit.vue';
import HoneyJarCreate from '@/Components/Honey/HoneyJarCreate.vue';



export default {
    components: {
        AuthenticatedLayout,
        Head,
        Modal,
        BreezeLabel,
        BreezeInput,
        HoneyJarCard,
        HoneyJarsRecord,
        HoneyJarsEdit,
        HoneyJarCreate,
    },
    props: ['honey_jars', 'records', 'users'],
    mounted() {
        //console.log(this.honey_jars);
        console.log(this.users);
        //console.log(this.records);
    },
};
</script>


