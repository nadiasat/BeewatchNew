
<template>
    <Head title="Documents" />

    <AuthenticatedLayout>
        <div class="container mx-auto p-4 w-full">
                <div>
                    <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">   
                        <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Documents</h2>
                        <DocumentCreate v-if="$page.props.auth.user.permissions.includes('manage documents')" 
                        :documents="documents"></DocumentCreate>
                    </div>
                </div>

                <hr>

                <BreezeValidationErrors class="my-8" />


                <div class="mt-8 flex flex-col gap-4">
                    <DocumentCard
                    v-for="document in documents"
                    :document="document"></DocumentCard>
                </div>




        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Modal from "@/Components/Modal.vue";
import DocumentCard from "@/Components/Document/DocumentCard.vue";
import DocumentCreate from '@/Components/Document/DocumentCreate.vue';
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";





export default {
    components: {
        AuthenticatedLayout,
        Head,
        Modal,
        BreezeLabel,
        BreezeInput,
        DocumentCard,
        DocumentCreate
    },
    props: ['documents'],
    methods: {
       
    },
    

    mounted() {
        console.log(this.documents);
    },
};
</script>


