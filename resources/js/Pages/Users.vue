<template>
    <Head title="Utilisateurs" />

    <BreezeAuthenticatedLayout>
        <div class="container mx-auto p-4">

            <div>
                <div class="flex flex-col lg:flex-row justify-between lg:flex-wrap my-5 px-1 lg:px-6 lg:items-center">
                    <h2 class="text-3xl font-bold mr-6 mb-5">Gestion des membres</h2>
                    <user-create></user-create>
                </div>
            </div>

            <hr>

            <BreezeValidationErrors class="my-8" />

            <div class="mt-10">
                <UserAwaitingActivation :users-awaiting-activation="users.awaiting_activation"></UserAwaitingActivation>
            </div>

            <div class="mt-8">
                <UserActivated :users-activated="users.activated" :apiaries="apiaries"></UserActivated>
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
import UserCreate from "@/Components/User/UserCreate.vue"
import BreezeValidationErrors from "@/Components/ValidationErrors.vue"

export default {
    components: {
        UserCreate,
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        Link,
        UserAwaitingActivation,
        UserActivated,
        //UserDisabled,
        BreezeValidationErrors,
    },
    props: ['users', 'apiaries'],
    mounted() {
        console.log(this.users);
    }
}
</script>
