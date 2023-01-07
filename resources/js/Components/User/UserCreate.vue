<template>
    <button @click="modalCreateUser = true"
        class="mb-4 bg-amber-400 border-amber-400 text-black border-4 py-2 font-semibold w-72 mr-5 hover:bg-amber-300 hover:border-amber-2 hover:text-white">
        Ajouter un membre
    </button>

    <Modal v-show="modalCreateUser" @close="modalCreateUser = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouveau membre</h4>
                <p class="text-center my-4">La personne concernée recevra un email avec un mot de passe généré aléatoirement qui lui permettra d'activer son compte.</p>
                <BreezeLabel for="firstname" value="Prénom" />
                <BreezeInput v-model="createUserForm.email" placeholder="Dupont" id="firstname" type="text" class="mt-1 block w-full" required />
                
                <BreezeLabel for="lastname" value="Nom" />
                <BreezeInput v-model="createUserForm.email" placeholder="Jean" id="lastname" type="text" class="mt-1 block w-full" required/>
                
                <BreezeLabel for="email" value="Adresse email" />
                <BreezeInput v-model="createUserForm.email" placeholder="john.doe@example.com" id="email" type="email" class="mt-1 block w-full" required autocomplete="email" />

                <BreezeLabel for="role" value="Rôle" />
                <select v-model="createUserForm.role" id="role" class="mt-1 block w-full">
                    <option value="1">Super administrateur</option>
                    <option value="2">Administrateur</option>
                    <option value="3">Utilisateur</option>
                </select>

                <button type="submit" :class="{ 'opacity-25': createUserForm.processing }" :disabled="createUserForm.processing" class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                    <button @click="modalCreateUser = false" class="text-red-1 font-semibold">Annuler</button>
            </div>
        </div>
    </Modal>

</template>

<script>
import Modal from "@/Components/Modal.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";
import Swal from "sweetalert2";

export default {
    name: "UserCreate",
    components: {
        Modal,
        BreezeLabel,
        BreezeInput
    },
    data: function () {
        return {
            modalCreateUser: false,
            createUserForm: useForm({
                firstname: null,
                lastname: null,
                email: null,
                role: null,
            }),
        }
    },
    methods: {
        submit(){
            this.createUserForm.post(route('users.store'), {
                preserveState: false,
                onSuccess() {
                        console.log('success');
                        Swal.fire({
                        icon: 'success',
                        title: 'Utilisateur créé avec succès',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                           toast.addEventListener('mouseenter', Swal.stopTimer)
                           toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        })
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
