<template>
    <Head title="Ruches" />

    <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4 w-full">
            <div>
                <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">
                    <div class="flex">
                        <back-button :previousRoute="previousRoute"></back-button>
                        <h2 class="text-3xl font-bold mr-6 mb-5 grow ">Gestion des ruches</h2>
                    </div>
                    <div class="flex flex-row gap-2">
                        <harvest-honey
                        v-if="$page.props.auth.user.permissions.includes('manage hives')"
                        :honey_jars="honey_jars"
                        :apiary_id="apiary_id">
                        </harvest-honey>
                        <hive-create
                        v-if="$page.props.auth.user.permissions.includes('manage hives')"
                        :apiary_id="apiary_id">
                        </hive-create>

                    </div>

                </div>
            </div>

            <div class="py-5 lg:py-12 px-4 mx-auto h-full ">
                <div class="flex flex-wrap gap-4 justify-center">
                    <hive-card v-for="hive in hives" :hive="hive"></hive-card>
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
import HiveCreate from "@/Components/Hive/HiveCreate.vue"
import HiveCard from "@/Components/Hive/HiveCard.vue"
import HarvestHoney from "@/Components/Hive/HarvestHoney.vue"
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { useForm } from "@inertiajs/inertia-vue3";

export default {
    components: {
        HiveCreate,
        HiveCard,
        HarvestHoney,
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        Link,
        BackButton,
        //UserDisabled,
        BreezeValidationErrors
    },
    props: {
        hives: {
            type: Array,
            required: true
        },
        apiary_id: {
            type: Number,
            required: true
        },
        previousRoute: {
            type: String,
            default: '/apiary'
        },
        honey_jars: {
            type: Array,
            required: true
        }
    },
    mounted() {

    }
}
</script>