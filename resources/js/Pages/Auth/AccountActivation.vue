<template>
    <Head title="Activer votre compte" />

    <div>
        <Link class="text-sm flex items-center" :href="route('login')">
            <svg class="mr-2" width="10" height="8" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.9999 6.99997H4.41394L9.70694 1.70697L8.29294 0.292969L0.585938 7.99997L8.29294 15.707L9.70694 14.293L4.41394 8.99997H18.9999V6.99997Z" fill="black"/>
            </svg>
            Retour
        </Link>
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">

        <h2 class="text-center text-2xl mb-8 mt-5 text-black-1">Activer votre compte</h2>

        <BreezeValidationErrors class="mb-4" />

        <div class="mb-4 mt-2 text-sm text-gray-600">
            Veuillez, s'il vous plaît, entrer un nouveau mot de passe pour votre compte afin de pouvoir l'activer.
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Nouveau mot de passe" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password_confirmation" value="Confirmation du mot de passe" />
            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="current-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="w-full bg-amber-400 text-zinc-900 py-4 text-normal" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Activer mon compte
            </BreezeButton>
        </div>
    </form>
</template>

<script>

import BreezeButton from '@/Components/PrimaryButton.vue'
import BreezeCheckbox from '@/Components/Checkbox.vue'
import BreezeGuestLayout from '@/Layouts/GuestLayout.vue'
import BreezeInput from '@/Components/TextInput.vue'
import BreezeLabel from '@/Components/InputLabel.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                password_confirmation: '',
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('users.activate_account'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
