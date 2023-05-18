<template>
    <Head title="Réinitialisation de mot de passe" />

    <BreezeValidationErrors class="mb-4" />

    <div>
        <Link class="text-sm flex items-center" :href="route('password.request')">
            <svg class="mr-2" width="10" height="8" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.9999 6.99997H4.41394L9.70694 1.70697L8.29294 0.292969L0.585938 7.99997L8.29294 15.707L9.70694 14.293L4.41394 8.99997H18.9999V6.99997Z" fill="black"/>
            </svg>
            Retour
        </Link>
    </div>

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
import { Link } from '@inertiajs/inertia-vue3';
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
        Link
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
