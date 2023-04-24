<template>
    <Head title="Réinitialisation de mot de passe" />

    <BreezeValidationErrors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="mt-1 block w-full bg-zinc-100" readonly v-model="form.email" required autofocus autocomplete="username" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password" value="Nouveau mot de passe" />
            <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
        </div>

        <div class="mt-4">
            <BreezeLabel for="password_confirmation" value="Confirmation du mot de passe" />
            <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <BreezeButton c class="w-full py-4 bg-amber-400 text-black hover:bg-amber-200" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
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
import { Head } from '@inertiajs/inertia-vue3';

import Swal from 'sweetalert2'



export default {
    layout: BreezeGuestLayout,

    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
    },

    props: {
        token: String,
        email: String,
    },

    data(props) {
        return {
            form: this.$inertia.form({
                token: props.token,
                email: props.email,
                password: '',
                password_confirmation: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.update'), {
                onSuccess: () => {
                    Swal.fire({
                        title: 'Mot de passe réinitialisé',
                        text: 'Vous pouvez maintenant vous connecter avec votre nouveau mot de passe',
                        icon: 'success',
                        confirmButtonText: 'Connexion'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$inertia.visit(this.route('login'))
                        } else {
                           this.form.reset('password', 'password_confirmation');
                        }
                    })
                }
            })
        }
    },
    mounted() {
        console.log(this.form);
    }
}
</script>
