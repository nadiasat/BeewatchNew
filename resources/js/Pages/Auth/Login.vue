<template>
    <Head title="Connexion" />

    <div v-if="status" class="mb-4 font-medium text-sm text-center text-green-600">
        {{ status }}
    </div>

    <form @submit.prevent="submit">

        <h2 class="text-center text-2xl mb-8 mt-5 text-black-1">Connexion à l'intranet</h2>

        <BreezeValidationErrors class="mb-4" />

        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Mot de passe" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
        </div>

        <!-- <div class="block mt-4">
            <label class="flex items-center">
                <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div> -->

        <div class="block mt-4">
            <Link class="underline hover:text-amber-800" :href="route('password.request')">Mot de passe oublié ? Changez-le ici</Link>
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton class="w-full py-4 bg-amber-400 text-black hover:bg-amber-200" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Connexion au portail
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
                remember: false
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('login'), {
                onFinish: () => this.form.reset('password'),
            })
        }
    }
}
</script>
