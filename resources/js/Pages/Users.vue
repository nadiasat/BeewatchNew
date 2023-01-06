<template>
    <Head title="Utilisateurs" />

    <BreezeAuthenticatedLayout>
        <!--<div class="container mx-auto p-4">

            <div>
                <div class="flex justify-between flex-wrap my-5 items-center">
                    <h2 class="text-3xl font-bold mr-6 mb-5">Utilisateurs</h2>
                    <user-create></user-create>
                </div>
            </div>

            <hr>

            <BreezeValidationErrors class="my-8" />

            <div class="mt-10">
                <UserAwaitingActivation :users-awaiting-activation="users.awaiting_activation"></UserAwaitingActivation>
            </div>

            <div class="mt-8">
                <UserActivated :users-activated="users.activated"></UserActivated>
            </div>

        </div>-->
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {Head} from '@inertiajs/inertia-vue3';
import BreezeButton from '@/Components/PrimaryButton.vue'
import {Link} from "@inertiajs/inertia-vue3";
import UserAwaitingActivation from "@/Components/User/UserAwaitingActivation";
import UserActivated from "@/Components/User/UserActivated";
import UserCreate from "@/Components/User/UserCreate";
import BreezeValidationErrors from "@/Components/ValidationErrors"

export default {
    components: {
        UserCreate,
        BreezeAuthenticatedLayout,
        Head,
        BreezeButton,
        Link,
        UserAwaitingActivation,
        UserActivated,
        UserDisabled,
        BreezeValidationErrors
    },
    props: ['users']
}
</script>
