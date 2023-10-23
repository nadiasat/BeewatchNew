<template>
    <Head title="Ruchers" />

    <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4 w-full">
        <div>
            <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">
                <h2 class="text-3xl font-bold mr-6 mb-5">Gestion des ruchers</h2>
                <apiary-create
                :inventory_places="inventory_places"
                v-if="$page.props.auth.user.permissions.includes('manage apiaries')">
                </apiary-create>
            </div>
        </div>

        <div class="py-5 lg:py-12 px-4 mx-auto h-full ">
            <div class="flex flex-wrap gap-4 justify-center ">
                <apiary-card v-for="apiary in apiaries" :apiary="apiary" :inventory_places="inventory_places"></apiary-card>
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
    props: ['apiaries', 'inventory_places'],
    mounted() {
        //console.log(this.inventory_places);
    }
}
</script>