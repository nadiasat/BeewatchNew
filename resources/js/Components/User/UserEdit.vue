<template>

    <button @click="modalUpdateUser = true"  class="flex items-center rounded-xl text-sm border-2 border-zinc-900 px-2 py-2 text-zinc-900 font-semibold mr-3 hover:bg-zinc-900 hover:text-white">
        <svg width="10" height="12" viewBox="0 0 10 12" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.501622 10.5325L1.10616 8.67699L2.32077 9.91963L0.500056 10.5405L0.500003 10.5398C0.500015 10.5395 0.500095 10.5372 0.501622 10.5325ZM8.26577 1.60164L9.21365 2.5714C9.40978 2.77206 9.40978 3.102 9.21365 3.30266L3.81906 8.82174L2.17237 7.13704L7.58291 1.60165C7.77281 1.40736 8.07587 1.40736 8.26577 1.60164Z" stroke="#181818"/>
        </svg>
    </button>

    <Modal v-show="modalUpdateUser" @close="modalUpdateUser = false">
        <div class="container">
            <form @submit.prevent="updateUser(user)" class="mx-8">
                <h4 class="mb-5 text-center text-2xl font-semibold">Nouveau membre</h4>

                <BreezeLabel for="role" value="Rôle" />
                <select v-model="updateUserForm.role" 
                id="role" 
                class="mt-1 block w-full
                border-zinc-300 
                focus:border-amber-400 focus:ring-amber-400 
                rounded-md shadow-sm" required>
                    <option value="superadmin">Super administrateur</option>
                    <option value="admin">Administrateur</option>
                    <option value="user">Utilisateur</option>
                </select>

                <BreezeLabel for="apiaries" value="Ruchers" />
                <div>
                    <VueMultiselect 
                    v-model="updateUserForm.apiaries"
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
                
                <!-- <select v-model="updateUserForm.apiaries" id="apiaries" class="mt-1 block w-full" multiple="multiple" required>
                     Foreach apiary in prop apiaries set to select when id exsists in user.apiaries
                    <option v-for="apiary in apiaries" :value="apiary.id" :selected="user.apiaries.includes(apiary.id)">{{ apiary.name }}</option>
                </select> -->

                <button type="submit" :class="{ 'opacity-25': updateUserForm.processing }"
                    :disabled="updateUserForm.processing"
                    @click="modalUpdateUser = false" 
                    class="mb-4 mt-8 bg-amber-400 border-amber-400 text-black font-semibold border-4 py-2 w-full hover:bg-amber-300 hover:border-amber-300">
                    Confirmer
                </button>
            </form>

            <div class="text-center">
                <button @click="modalUpdateUser = false" class="text-red-1 font-semibold">Annuler</button>
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
import Swal from 'sweetalert2';

export default {
    name: "UserEdit",
    props:['user', 'apiaries'],
    data: function (props) {
        return {
            updateUserForm: useForm({
                id: props.user.id,
                role: props.user.role,
                apiaries: props.user.apiaries,
            }),
            modalUpdateUser: false,
            options: props.apiaries,

        };
    },
    methods: {
        updateUser(user) {
            console.log("UPDATE USER");
            this.updateUserForm.put(route('users.update', user), {
                preserveState: false,
                onSuccess() {
                    console.log('success');
                    Swal.fire({
                        icon: 'success',
                        title: 'Utilisateur modifié avec succès',
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
        }, 
        addTag (newTag) {
            const tag = {
                name: newTag,
                code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
            }
            this.options.push(tag)
            this.value.push(tag)
        },
    },
    components: {
        Modal,
        BreezeLabel,
        BreezeInput,
        VueMultiselect ,
    },
    mounted() {
        console.log(this.apiaries);
    }
};



</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>