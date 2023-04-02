<template>
    <Head title="Détails" />

    <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4">
        <div>
                <div class="flex justify-between flex-wrap my-5 items-center">
                    <back-button></back-button>
                    <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Détails : {{ hive_name }}</h2>
                </div>
            </div>

        <div class="py-12 px-4 mx-auto h-full ">
            <div class="flex flex-wrap gap-4 justify-center">
                <InterventionCard v-for="intervention in interventions" :intervention="intervention"></InterventionCard>
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
import BackButton from "@/Components/BackButton.vue";
import InterventionCard from '@/Components/Hive/InterventionCard.vue';
import BreezeValidationErrors from "@/Components/ValidationErrors.vue"

export default {
    components: {
        InterventionCard,
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        Link,
        BackButton,
        //UserDisabled,
        BreezeValidationErrors
    },
    props: ['interventions', 'hive_id', 'hive_name'],
    mounted() {
        //console.log(this.hive_name)
        //console.log segment of url
    }
}
</script>