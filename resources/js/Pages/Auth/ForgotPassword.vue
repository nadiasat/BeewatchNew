<template>
    <Head title="Mot de passe oublié" />

    <div>
        <Link class="text-sm flex items-center" :href="route('login')">
            <svg class="mr-2" width="10" height="8" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.9999 6.99997H4.41394L9.70694 1.70697L8.29294 0.292969L0.585938 7.99997L8.29294 15.707L9.70694 14.293L4.41394 8.99997H18.9999V6.99997Z" fill="black"/>
            </svg>
            Retour
        </Link>
    </div>

    <div class="mb-4 mt-2 text-sm text-gray-600">
        Vous avez oublié votre mot de passe ? Entrez votre adresse e-mail ci-dessous pour réinitialiser votre mot de passe.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="w-full py-4 bg-amber-400 text-black hover:bg-amber-200" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Réinitialiser le mot de passe
            </BreezeButton>
        </div>
    </form>
</template>

<script>
import BreezeButton from '@/Components/PrimaryButton.vue'
import BreezeGuestLayout from '@/Layouts/GuestLayout.vue'
import BreezeInput from '@/Components/TextInput.vue'
import BreezeLabel from '@/Components/InputLabel.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';



export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.email'))
        }
    }
}
</script>
