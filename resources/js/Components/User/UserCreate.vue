<template>


    <button @click="modalCreateUser = true" 
    class="flex justify-center items-center mb-4 border-zinc-900 bg-white text-zinc-900 border-2 rounded-xl py-2 font-semibold w-full lg:w-72 mr-5 hover:bg-zinc-900 hover:text-white"
    id="create-user-button">
        <svg class="fill-zinc-900 mr-4" width="16" height="16" viewBox="0 0 12 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 6H6M12 6H6M6 6V0M6 6V12" stroke="currentColor"/>
        </svg>
        Ajouter un membre

    </button>




    <Modal v-show="modalCreateUser" @close="modalCreateUser = false">
        <div class="container">
            <form @submit.prevent="submit" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouveau membre</h4>
                <p class="text-center my-4">La personne concernée recevra un email avec un mot de passe généré
                    aléatoirement qui lui permettra d'activer son compte.</p>
                <BreezeLabel for="firstname" value="Prénom" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                <BreezeInput v-model="createUserForm.firstname" placeholder="Dupont" id="firstname" type="text"
                    class="mt-1 block w-full" required autocomplete="fisrtname"/>

                <BreezeLabel for="lastname" value="Nom" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                <BreezeInput v-model="createUserForm.lastname" placeholder="Jean" id="lastname" type="text"
                    class="mt-1 block w-full" required autocomplete="lastname"/>

                <BreezeLabel for="email" value="Adresse email" class=" font-bold text-base mt-4 lg:mt-0 text-zinc-900 "/>
                <BreezeInput v-model="createUserForm.email" placeholder="john.doe@example.com" id="email" type="email"
                    class="mt-1 block w-full" required autocomplete="email" />

                <BreezeLabel for="role" value="Rôle" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                <select v-model="createUserForm.role" 
                id="role" 
                class="mt-1 block w-full
                border-zinc-300 
                focus:border-amber-400 focus:ring-amber-400 
                rounded-md shadow-sm" required>
                    <option value="superadmin">Super administrateur</option>
                    <option value="admin">Administrateur</option>
                    <option value="user">Utilisateur</option>
                </select>

                <BreezeLabel for="apiaries" value="Ruchers" class="font-bold text-base mt-4 lg:mt-0 text-zinc-900"/>
                <div>
                    <VueMultiselect 
                    v-model="createUserForm.apiaries"
                    :options="options"
                    :taggable="true"
                    :multiple="true"
                    :label="'name'"
                    :track-by="'id'"
                    id="apiaries" 
                    class="mt-1 block w-full" 
                    @tag="addTag">
                    </VueMultiselect>
                </div>

                <button type="submit" :class="{ 'opacity-25': createUserForm.processing }"
                    :disabled="createUserForm.processing"
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
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
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeLabel from "@/Components/InputLabel.vue";
import BreezeInput from "@/Components/TextInput.vue";
import VueMultiselect from 'vue-multiselect';
import Swal from "sweetalert2";

export default {
    name: "UserCreate",
    props: ['apiaries'],
    components: {
        Modal,
        BreezeLabel,
        BreezeInput,
        VueMultiselect ,
    },
    data: function (props) {
        return {
            modalCreateUser: false,
            createUserForm: useForm({
                firstname: null,
                lastname: null,
                email: null,
                role: null,
                apiaries: [],
            }),
            options: props.apiaries,
        }
    },
    methods: {
        submit() {
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
                },
                //on error callback print error message
            })
        },
        addTag (newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.options.push(tag)
            this.value.push(tag)
        },
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>