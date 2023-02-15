<template>
    <Head title="Ruchers" />

    <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4">
        <div>
                <div class="flex justify-between flex-wrap my-5 items-center">
                    <h2 class="text-3xl font-bold mr-6 mb-5">Gestion des ruchers</h2>
                    <apiary-create></apiary-create>
                </div>
            </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-sm sm:rounded-lg flex">
                    <apiary-card></apiary-card>
                </div>

            </div>
        </div>


        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
            </div>
        </div>
    </div>

    


        
   
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head} from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/PrimaryButton.vue'
import {Link} from "@inertiajs/inertia-vue3";
import UserAwaitingActivation from "@/Components/User/UserAwaitingActivation.vue";
import UserActivated from "@/Components/User/UserActivated.vue";
import ApiaryCreate from "@/Components/Apiary/ApiaryCreate.vue"
import ApiaryCard from "@/Components/Apiary/ApiaryCard.vue"
import BreezeValidationErrors from "@/Components/ValidationErrors.vue"

export default {
    components: {
        ApiaryCreate,
        ApiaryCard,
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        Link,
        UserAwaitingActivation,
        UserActivated,
        //UserDisabled,
        BreezeValidationErrors
    },
    props: ['apiaries'],
    mounted() {
        console.log(this.apiaries);
    }
}
</script>