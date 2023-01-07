<template>
    <Head title="Activer votre compte" />

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
            <BreezeButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
